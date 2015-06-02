<?php

namespace Traditional\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;
use Traditional\Domain\Model\UserRepository;

class WhenUserRegisteredSendWelcomeEmail implements MessageSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(\Swift_Mailer $mailer, UserRepository $userRepository)
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    public function notify(Message $message)
    {
        /** @var UserRegistered $message */

        $mailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $user = $this->userRepository->byId($message->userId());
        $mailMessage->setTo($user->getEmail());
        $this->mailer->send($mailMessage);
    }
}
