<?php

namespace Traditional\Bundle\UserBundle\Controller\Rest;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Traditional\User\Command\RegisterUser;

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
        $command = $this->commandFromRequestBody($request);

        $this->get('command_bus')->handle($command);

        $response = new Response('', Response::HTTP_ACCEPTED);
        $response->headers->set('Location', $this->generateUrl('api_user_details', ['id' => $command->getId()], true));

        return $response;
    }

    /**
     * @Route("/{id}/", name="api_user_details")
     * @Method("GET")
     */
    public function detailsAction($id)
    {
        try {
            $user = $this->get('user_repository')->byId($id);
        } catch (\DomainException $exception) {
            throw new NotFoundHttpException('User not found', $exception);
        }

        $userSummary = UserSummary::fromEntity($user);

        $serializedUser = $this->get('jms_serializer')->serialize($userSummary, 'json');

        return new Response($serializedUser);
    }

    private function commandFromRequestBody(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $command = $serializer->deserialize(
            $request->getContent(),
            RegisterUser::class,
            'json'
        );

        return $command;
    }
}
