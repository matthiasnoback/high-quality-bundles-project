<?php

namespace Traditional\Bundle\UserBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use User\Command\RegisterUser;

/**
 * @Route("/api/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/register")
     * @Method({"POST"})
     */
    public function registerAction(Request $request)
    {
        $command = $this->get('jms_serializer')
            ->deserialize(
                $request->getContent(),
                RegisterUser::class,
                'json'
            );

        $this->get('command_bus')->handle($command);

        return new Response('', Response::HTTP_ACCEPTED);
    }
}
