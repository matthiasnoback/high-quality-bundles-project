<?php

namespace Infrastructure\Web;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Infrastructure\Web\CreateUserType;

class UserController extends Controller
{
    /**
     * @Template("@UserViews/list.html.twig")
     */
    public function listAction()
    {
        $users = $this
            ->get('user_repository')
            ->all();

        return array(
            'users' => $users
        );
    }

    /**
     * @Template("@UserViews/create.html.twig")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm('create_user');

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
