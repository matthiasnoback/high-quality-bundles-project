<?php

namespace Traditional\Core\User\Register;

use SimpleBus\Command\Command;
use SimpleBus\Command\Handler\CommandHandler;
use Traditional\Infrastructure\Persistence\DoctrineORM\UserRepository;

class SendWelcomeMailCommandHandler implements CommandHandler
{
    private $mailer;
    private $userRepository;

    public function __construct(UserRepository $userRepository, \Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    /**
     * @param SendWelcomeMail $command
     * @return void
     */
    public function handle(Command $command)
    {
        $user = $this->userRepository->getById($command->userId());

        $message = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $message->setTo((string) $user->getEmail());
        $this->mailer->send($message);
    }
}
