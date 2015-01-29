<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class SendWelcomeMailHandler implements MessageHandler
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(Message $message)
    {
        if (!($message instanceof SendWelcomeMail)) {
            throw new \LogicException();
        }

        $mail = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $mail->setTo((string) $message->user()->getEmail());
        $this->mailer->send($mail);
    }
}
