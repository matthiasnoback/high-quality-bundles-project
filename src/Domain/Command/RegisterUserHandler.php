<?php

namespace Domain\Command;

use Domain\Command\RegisterUser;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;
use SimpleBus\Message\Recorder\RecordsMessages;
use Domain\Model\Email;
use Domain\Model\User;
use Domain\Model\UserRepository;
use Domain\Event\UserWasRegistered;

class RegisterUserHandler implements MessageHandler
{
    /**
     * @var RecordsMessages
     */
    private $eventRecorder;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        RecordsMessages $eventRecorder
    ) {
        $this->eventRecorder = $eventRecorder;
        $this->userRepository = $userRepository;
    }

    public function handle(Message $message)
    {
        if (!($message instanceof RegisterUser)) {
            throw new \LogicException();
        }

        $user = new User(
            $message->id(),
            Email::fromString($message->email),
            $message->password,
            $message->country
        );

        $this->userRepository->add($user);

        $event = new UserWasRegistered($user);
        $this->eventRecorder->record($event);
    }
}
