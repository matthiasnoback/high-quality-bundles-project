<?php

namespace Traditional\Bundle\UserBundle\Controller\User;

use Traditional\Bundle\UserBundle\Entity\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ListAction
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Template("TraditionalUserBundle:User:list.html.twig")
     */
    public function __invoke()
    {
        $users = $this->userRepository->findDutchUsers();

        return array(
            'users' => $users
        );
    }
}
