<?php

namespace Traditional\Bundle\UserBundle\Controller;

use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Traditional\Bundle\UserBundle\Command\RegisterUser;

/**
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * @Route("/create", name="traditional_user_create")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm('create_user');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $command = $form->getData();

            $this->get('command_bus')->handle($command);

            return $this->redirect($this->generateUrl('traditional_user_list', ['id' => $command->id]));
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/api/create", name="traditional_user_api_create")
     * @Method({"POST"})
     */
    public function apiCreateAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        /** @var $serializer SerializerInterface */
        $command = $serializer->deserialize($request->getContent(), RegisterUser::class, 'json');
        $constraintViolationList = $this->get('validator')->validate($command);

        if (count($constraintViolationList) === 0) {
            $this->get('command_bus')->handle($command);

            return new JsonResponse(null, 201);
        }

        return new Response(
            $serializer->serialize($constraintViolationList, 'json')
        , 400);
    }
}
