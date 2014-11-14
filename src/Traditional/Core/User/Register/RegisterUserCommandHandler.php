<?php

namespace Traditional\Core\User\Register;

use Doctrine\ORM\EntityManager;
use SimpleBus\Command\Command;
use SimpleBus\Command\Handler\CommandHandler;
use Traditional\Core\Model\Email;
use Traditional\Core\Model\PhoneNumber;
use Traditional\Core\Model\User;

class RegisterUserCommandHandler implements CommandHandler
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param RegisterUser $command
     */
    public function handle(Command $command)
    {
        $user = new User(
            $command->id(),
            Email::fromString($command->email()),
            $command->password(),
            $command->country()
        );

        $defaultPhoneNumber = new PhoneNumber('0031', '030', '1234567');
        $user->addPhoneNumber($defaultPhoneNumber);

        $this->entityManager->persist($user);
    }
}
