<?php

namespace Derp\Bundle\ERBundle\Controller;

use Derp\Command\RegisterWalkIn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/api/patients/")
 */
class PatientRestController extends Controller
{
    /**
     * @Route("/walk-ins/")
     * @Method("post")
     */
    public function registerAction(Request $request)
    {
        $command = $this->get('jms_serializer')->deserialize($request->getContent(), RegisterWalkIn::class, 'json');

        $this->get('command_bus')->handle($command);

        return new Response(null, Response::HTTP_CREATED);
    }
}
