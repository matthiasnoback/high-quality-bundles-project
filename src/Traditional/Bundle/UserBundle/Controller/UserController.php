<?php

namespace Traditional\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Traditional\Bundle\UserBundle\Form\CreateUserType;

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

            return $this->redirect($this->generateUrl('user_list', ['id' => $command->id()]));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
