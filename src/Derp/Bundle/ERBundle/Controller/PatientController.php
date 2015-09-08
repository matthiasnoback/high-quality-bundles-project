<?php

namespace Derp\Bundle\ERBundle\Controller;

use Derp\Bundle\ERBundle\Entity\PatientId;
use Derp\Bundle\ERBundle\Entity\PatientNotFound;
use Derp\Bundle\ERBundle\Form\RegisterWalkInType;
use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Command\RegisterWalkIn;
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
            ->getDoctrine()
            ->getManager()
            ->getRepository(Patient::class)
            ->findAll();

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
            ->getDoctrine()
            ->getManager()
            ->getRepository(Patient::class)
            ->findBy(
                ['personalInformation.name.lastName' => $request->query->get('lastName')]
            );

        return array(
            'patients' => $patients
        );
    }

    /**
     * @Route("/register-walk-in/", name="register_walk_in")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function registerWalkInAction(Request $request)
    {
        $command = new RegisterWalkIn();
        $form = $this->createForm(new RegisterWalkInType(), $command);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $id = $this->get('patient_repository')->nextIdentity();
            $command->nurseId = $user->getId();
            $command->id = (string) $id;

            $this->get('command_bus')->handle($command);

            return $this->redirect($this->generateUrl('patient_details', ['id' => $id]));
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
            $patient = $this->get('patient_repository')->getById(PatientId::fromString($id));
        } catch (PatientNotFound $exception) {
            throw $this->createNotFoundException('Patient not found', $exception);
        }

        return array(
            'patient' => $patient
        );
    }
}
