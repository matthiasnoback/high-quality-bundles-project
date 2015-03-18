<?php

namespace Domain\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenUserWasRegisteredSendWelcomeEmail implements MessageSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(
        \Swift_Mailer $mailer
    ) {
        $this->mailer = $mailer;
    }

    public function notify(Message $message)
    {
        if (!($message instanceof UserWasRegistered)) {
            throw new \LogicException('Expected a UserWasRegistered message');
        }

        $user = $message->user();

        $message = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $message->setTo((string) $user->getEmail());
        $this->mailer->send($message);
    }
}
