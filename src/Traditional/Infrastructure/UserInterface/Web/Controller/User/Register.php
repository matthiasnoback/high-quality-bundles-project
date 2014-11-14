<?php

namespace Traditional\Infrastructure\UserInterface\Web\Controller\User;

use SimpleBus\Command\Bus\CommandBus;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;
use Traditional\Core\Model\UserRepository;
use Traditional\Infrastructure\UserInterface\Web\Form\RegisterUserType;

class Register
{
    private $userRepository;
    private $commandBus;
    private $templating;
    private $formFactory;
    private $router;

    public function __construct(
        UserRepository $userRepository,
        CommandBus $commandBus,
        EngineInterface $templating,
        FormFactoryInterface $formFactory,
        RouterInterface $router
    ) {
        $this->userRepository = $userRepository;
        $this->commandBus = $commandBus;
        $this->templating = $templating;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    public function __invoke(Request $request)
    {
        $form = $this->formFactory->create(new RegisterUserType());

        $form->handleRequest($request);

        if ($form->isValid()) {
            $command = $form->getData();
            $this->commandBus->handle($command);

            return new RedirectResponse(
                $this->router->generate(
                    'user_list',
                    array(
                        'id' => $command->id()
                    )
                ), 302
            );
        }

        return new Response(
            $this->templating->render(
                'TraditionalUserBundle:User:register.html.twig',
                array(
                    'form' => $form->createView()
                )
            )
        );
    }
}
