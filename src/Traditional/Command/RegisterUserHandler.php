<?php

namespace Traditional\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Domain\Model\Country;
use Traditional\Domain\Model\UserRepository;

class RegisterUserHandler implements MessageHandler
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Message $message)
    {
        /** @var RegisterUser $message */

        $user = new User(
            $message->id(),
            $message->email,
            $message->password,
            Country::fromCountryCode($message->country)
        );

        $this->repository->add($user);
    }
}
