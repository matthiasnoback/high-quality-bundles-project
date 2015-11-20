<?php

namespace Derp\Infrastructure\Web\Controller;

use Derp\Domain\Model\Patient\PatientId;
use Derp\Domain\Model\Patient\PatientNotFound;
use Derp\Infrastructure\Web\Form\CreatePatientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class PatientController extends Controller
{
    /**
     * @Template("@Derp/Patient/list.html.twig")
     */
    public function listAction()
    {
        $patients = $this
            ->get('patient_list_view_model_repository')
            ->all();

        return array(
            'patients' => $patients
        );
    }

    /**
     * @Template("@Derp/Patient/list.html.twig")
     */
    public function findByLastName(Request $request)
    {
        $patients = $this
            ->get('patient_repository')
            ->byLastName($request->query->get('lastName'));

        return array(
            'patients' => $patients
        );
    }

    /**
     * @Template("@Derp/Patient/create.html.twig")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(new \Derp\Infrastructure\Web\Form\CreatePatientType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $command = $form->getData();
            $command->id = (string) PatientId::generate();
            $this->get('command_bus')->handle($command);

            return $this->redirect($this->generateUrl('patient_details', ['id' => $command->id]));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Template("@Derp/Patient/details.html.twig")
     */
    public function detailsAction($id)
    {
        try {
            $patient = $this->get('patient_repository')->byId($id);
        } catch (PatientNotFound $exception) {
            throw $this->createNotFoundException(
                'Patient not found',
                $exception
            );
        }

        return array(
            'patient' => $patient
        );
    }
}
