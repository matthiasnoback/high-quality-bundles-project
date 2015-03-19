<?php

namespace Domain\Event;

use Domain\Model\UserRepository;
use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenUserWasRegisteredSendWelcomeEmail implements MessageSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository,
        \Swift_Mailer $mailer
    ) {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    public function notify(Message $message)
    {
        if (!($message instanceof UserWasRegistered)) {
            throw new \LogicException('Expected a UserWasRegistered message');
        }

        $user = $this->userRepository->byId($message->userId());

        $message = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $message->setTo((string) $user->getEmail());
        $this->mailer->send($message);
    }
}
