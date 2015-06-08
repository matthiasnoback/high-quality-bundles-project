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
     * @Route("/create-patient", name="patient_create")
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
            $message->setTo('matthiasnoback@gmail.com');
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('patient_list'));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
