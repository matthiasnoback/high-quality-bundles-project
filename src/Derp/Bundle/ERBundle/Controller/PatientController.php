<?php

namespace Derp\Bundle\ERBundle\Controller;

use Derp\Bundle\ERBundle\Entity\PatientId;
use Derp\Bundle\ERBundle\Entity\PatientNotFound;
use Derp\Bundle\ERBundle\Form\CreatePatientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/patients")
 */
class PatientController extends Controller
{
    /**
     * @Route("/", name="patient_list")
     * @Template()
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
     * @Route("/find-by-last-name/", name="patient_find_by_last_name")
     * @Template("@DerpERBundle/Resources/views/Patient/list.html.twig")
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
     * @Route("/create/", name="patient_create")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(new CreatePatientType());

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
     * @Route("/{id}/", name="patient_details")
     * @Method("GET")
     * @Template()
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
