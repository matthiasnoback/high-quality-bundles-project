<?php

namespace Traditional\Bundle\UserBundle\Command;

use Assert\Assertion;
use Doctrine\Common\Persistence\ManagerRegistry;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\EmailAddress;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Bundle\UserBundle\Entity\UserRepository;

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
     * @param RegisterUser $message
     */
    public function handle(Message $message)
    {
        Assertion::isInstanceOf($message, RegisterUser::class);

        $user = User::register(
            $message->id(),
            EmailAddress::fromString($message->email()),
            $message->password(),
            $message->country()
        );

        $this->userRepository->add($user);
    }
}
