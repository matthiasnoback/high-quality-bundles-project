<?php

namespace Traditional\Bundle\UserBundle\Command;

use Doctrine\Common\Persistence\ManagerRegistry;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use SimpleBus\Message\Recorder\RecordsMessages;
use Traditional\Bundle\UserBundle\Entity\Email;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Bundle\UserBundle\Event\UserWasRegistered;

class RegisterUserHandler implements MessageHandler
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    /**
     * @var RecordsMessages
     */
    private $eventRecorder;

    public function __construct(
        ManagerRegistry $doctrine,
        RecordsMessages $eventRecorder
    ) {
        $this->doctrine = $doctrine;
        $this->eventRecorder = $eventRecorder;
    }

    public function handle(Message $message)
    {
        if (!($message instanceof RegisterUser)) {
            throw new \LogicException();
        }

        $user = new User(
            Email::fromString($message->email),
            $message->password,
            $message->country
        );
        $em = $this->doctrine->getManager();
        $em->persist($user);

        $event = new UserWasRegistered($user);
        $this->eventRecorder->record($event);
    }
}
