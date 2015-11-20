<?php

namespace Derp\Infrastructure\Api\Controller;

use Derp\Application\RegisterWalkIn;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RestPatientController extends Controller
{
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
