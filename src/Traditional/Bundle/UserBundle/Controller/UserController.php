<?php

namespace Traditional\Bundle\UserBundle\Controller;

use Rhumsaa\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Bundle\UserBundle\Form\CreateUserType;
use Traditional\Command\RegisterUser;

/**
 * @Route("/")
 */
class UserController extends Controller
{
    /**
     * @Route("/", name="user_list")
     * @Template
     */
    public function listAction()
    {
        $users = $this->get('user_repository')->all();

        return array(
            'users' => $users
        );
    }

    /**
     * @Route("/users/{id}/", name="rest_user_full")
     */
    public function restFullAction($id)
    {
        $user = $this->get('user_repository')->byId($id);

        return new JsonResponse(['email' => $user->getEmail()]);
    }

    /**
     * @Route("/users/", name="rest_user_list")
     */
    public function restListAction()
    {
        $users = $this->get('user_repository')->all();

        $userDtos = array_map(function(User $user) {
            return ['id' => (string) $user->getId(), '_links' => ['self' => $this->generateUrl('rest_user_full', ['id' => $user->getId()], true)]];
        }, $users);

        return new JsonResponse(['users' => $userDtos, 'count' => count($userDtos)]);
    }

    /**
     * @Route("/users/", name="rest_user_create")
     * @Method({"POST"})
     */
    public function createRestAction(Request $request)
    {
        $command = $this->get('jms_serializer')->deserialize($request->getContent(), RegisterUser::class, 'json');

        $this->get('command_bus')->handle($command);

        return new Response();
    }

    /**
     * @Route("/create-user", name="user_create")
     * @Method({"GET", "POST"})
     * @Template
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(new CreateUserType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $command = $form->getData();

            $this->get('command_bus')->handle($command);

            return $this->redirect($this->generateUrl('user_list') . '?id=' . $command->id());
        }

        return array(
            'form' => $form->createView()
        );
    }
}
