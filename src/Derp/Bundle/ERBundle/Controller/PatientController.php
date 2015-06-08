<?php

namespace Derp\Bundle\ERBundle\Controller;

use Derp\Bundle\ERBundle\Form\CreatePatientType;
use Derp\Bundle\ERBundle\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
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
     * @Route("/create-patient/", name="patient_create")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function createAction(Request $request)
    {
        $patient = new Patient();

        $form = $this->createForm(new CreatePatientType(), $patient);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($patient);
            $em->flush();

            // TODO think of a relevant secondary task!
            $message = \Swift_Message::newInstance('New patient', 'I hope we can help them');
            $message->setTo('matthiasnoback+head-nurse@gmail.com');
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('patient_details', ['id' => $patient->getId()]));
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
        $patient = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Patient::class)
            ->find($id);

        if ($patient === null) {
            throw $this->createNotFoundException();
        }

        return array(
            'patient' => $patient
        );
    }
}
