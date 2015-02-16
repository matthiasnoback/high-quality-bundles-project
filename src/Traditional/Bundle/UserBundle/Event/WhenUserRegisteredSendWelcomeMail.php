<?php

namespace Traditional\Bundle\UserBundle\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenUserRegisteredSendWelcomeMail implements MessageSubscriber
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
     * @param UserRegistered $message
     */
    public function notify(Message $message)
    {
        $mailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $mailMessage->setTo((string) $message->user()->getEmail());
        $this->mailer->send($mailMessage);
    }
}
