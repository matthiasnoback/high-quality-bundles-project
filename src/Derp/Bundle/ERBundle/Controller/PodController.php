<?php

namespace Derp\Bundle\ERBundle\Controller;

use Derp\Bundle\ERBundle\Entity\Pod;
use Derp\Bundle\ERBundle\Form\RegisterWalkInType;
use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Form\CreatePodType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/pods")
 */
class PodController extends Controller
{
    /**
     * @Route("/", name="pod_list")
     * @Template()
     */
    public function listAction()
    {
        $pods = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository(Pod::class)
            ->findAll();

        return array(
            'pods' => $pods
        );
    }

    /**
     * @Route("/create/", name="pod_create")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function createAction(Request $request)
    {
        $pod = new Pod();

        $form = $this->createForm(new CreatePodType(), $pod);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $numberOfBeds = $form->get('numberOfBeds')->getData();
            $pod->allocateBeds($numberOfBeds);

            $em = $this->getDoctrine()->getManager();
            $em->persist($pod);
            $em->flush();

            return $this->redirect($this->generateUrl('pod_list'));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
