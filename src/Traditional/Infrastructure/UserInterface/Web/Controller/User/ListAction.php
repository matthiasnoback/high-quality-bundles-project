<?php

namespace Traditional\Infrastructure\UserInterface\Web\Controller\User;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\EngineInterface;
use Traditional\Core\Model\UserRepository;

class ListAction
{
    private $userRepository;
    private $templating;

    public function __construct(
        UserRepository $userRepository,
        EngineInterface $templating
    ) {
        $this->userRepository = $userRepository;
        $this->templating = $templating;
    }

    public function __invoke()
    {
        $users = $this
            ->userRepository
            ->findAllUsersOrderedByCountry();

        return new Response(
            $this->templating->render(
                'TraditionalUserBundle:User:list.html.twig',
                array(
                    'users' => $users
                )
            )
        );
    }
}
