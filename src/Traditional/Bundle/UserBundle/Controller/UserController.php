<?php

namespace Traditional\Bundle\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Traditional\Bundle\UserBundle\Entity\User;
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
        $users = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('Traditional\Bundle\UserBundle\Entity\User')
            ->findAll();

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
        $user = new User();

        $form = $this->createForm(new CreateUserType(), $user);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $message = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
            $message->setTo($user->getEmail());
            $this->get('mailer')->send($message);

            return $this->redirect($this->generateUrl('user_list'));
        }

        return array(
            'form' => $form->createView()
        );
    }
}
