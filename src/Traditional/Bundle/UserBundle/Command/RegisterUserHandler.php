<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use Traditional\Bundle\UserBundle\Entity\EmailAddress;
use Traditional\Bundle\UserBundle\Entity\PhoneNumber;
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

    public function handle(Message $message)
    {
        if (!($message instanceof RegisterUser)) {
            throw new \LogicException();
        }

        $user = User::register(
            $message->id(),
            EmailAddress::fromString($message->email()),
            $message->password(),
            $message->country()
        );

        $defaultPhoneNumber = new PhoneNumber();
        $defaultPhoneNumber->setCountryCode('0031');
        $defaultPhoneNumber->setAreaCode('030');
        $defaultPhoneNumber->setLineNumber('1234567');
        $user->addPhoneNumber($defaultPhoneNumber);

        $this->userRepository->add($user);
    }
}
