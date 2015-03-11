<?php

namespace Traditional\Bundle\UserBundle\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;
use Traditional\Bundle\UserBundle\Entity\UserRepository;

class WhenUserWasRegisteredSendWelcomeMail implements MessageSubscriber
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

    /**
     * @param UserWasRegistered $message
     */
    public function notify(Message $message)
    {
        $user = $this->userRepository->byId($message->userId());

        $emailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $emailMessage->setTo((string) $user->getEmail());
        $this->mailer->send($emailMessage);
    }
}
