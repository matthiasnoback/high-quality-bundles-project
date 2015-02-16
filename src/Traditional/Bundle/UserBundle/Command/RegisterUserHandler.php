<?php

namespace Traditional\Bundle\UserBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\Email;
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
        $user = User::register($message->id, Email::fromString($message->email), $message->password, $message->country);

        $this->userRepository->add($user);
    }
}
