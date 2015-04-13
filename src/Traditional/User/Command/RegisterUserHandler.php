<?php

namespace Traditional\User\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Traditional\User\Command\RegisterUser;
use Traditional\User\Domain\Model\Email;
use Traditional\User\Domain\Model\User;
use Traditional\User\Domain\Model\UserRepository;

class RegisterUserHandler implements MessageHandler
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Message $message)
    {
        if (!$message instanceof RegisterUser) {
            throw new \LogicException();
        }

        $user = User::register($message->getId(), Email::fromString($message->email), $message->password, $message->country);

        $this->userRepository->add($user);
    }
}
