<?php

namespace User\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\User;
use User\Domain\Model\Country;
use User\Domain\Model\UserRepository;

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

    /**
     * Handles the given message.
     *
     * @param RegisterUser $message
     * @return void
     */
    public function handle(Message $message)
    {
        $user = User::register(
            $message->getId(),
            $message->email,
            $message->password,
            Country::fromCountryCode($message->country)
        );

        $this->userRepository->add($user);
    }
}
