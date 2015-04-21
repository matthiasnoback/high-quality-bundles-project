<?php

namespace User\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;
use User\Domain\Model\UserRepository;

class WhenUserWasRegisteredSendWelcomeEmail implements MessageSubscriber
{
    private $mailer;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository, \Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->userRepository = $userRepository;
    }

    /**
     * Provide the given message as a notification to this subscriber
     *
     * @param UserWasRegistered $message
     * @return void
     */
    public function notify(Message $message)
    {
        $id = $message->userId();
        $user = $this->userRepository->byId($id);

        $mailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $mailMessage->setTo($user->getEmail());
        $this->mailer->send($mailMessage);
    }
}
