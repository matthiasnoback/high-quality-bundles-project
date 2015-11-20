<?php

namespace Derp\Bundle\ERBundle\Controller;

use Derp\Application\RegisterWalkIn;
use JMS\Serializer\DeserializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(path="/rest/patients")
 */
class RestPatientController extends Controller
{
    /**
     * @Route(path="/register-walk-in", methods={"POST"})
     */
    public function registerWalkInAction(Request $request)
    {
        $request->setRequestFormat('json');
        $commandClass = RegisterWalkIn::class;
        $this->handleSerializedCommand($request->getContent(), $commandClass);

        return new Response('', Response::HTTP_CREATED);
    }

    /**
     * @param string $serializedCommand
     * @param $commandClass
     */
    private function handleSerializedCommand($serializedCommand, $commandClass)
    {
        $command = $this->get('jms_serializer')->deserialize(
            $serializedCommand,
            $commandClass,
            'json'
        );
        $this->get('command_bus')->handle($command);
    }
}
