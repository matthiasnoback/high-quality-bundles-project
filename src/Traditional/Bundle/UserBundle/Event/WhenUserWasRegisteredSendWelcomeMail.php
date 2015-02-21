<?php

namespace Traditional\Bundle\UserBundle\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenUserWasRegisteredSendWelcomeMail implements MessageSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param UserWasRegistered $message
     */
    public function notify(Message $message)
    {
        $emailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $emailMessage->setTo((string) $message->user()->getEmail());
        $this->mailer->send($emailMessage);
    }
}
