<?php

namespace Traditional\User\Application\Service;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;
use Traditional\User\Domain\Event\UserRegistered;

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

    public function notify(Message $message)
    {
        if (!$message instanceof UserRegistered) {
            throw new \LogicException();
        }

        $mailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $mailMessage->setTo((string)$message->userEmail());
        $this->mailer->send($mailMessage);
    }
}
