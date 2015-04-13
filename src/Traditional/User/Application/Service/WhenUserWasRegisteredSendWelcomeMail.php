<?php

namespace Traditional\User\Application\Service;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;
use Traditional\User\Domain\Event\UserRegistered;
use Traditional\User\Domain\Model\UserRepository;

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

    public function notify(Message $message)
    {
        if (!$message instanceof UserRegistered) {
            throw new \LogicException();
        }

        $user = $this->userRepository->byId($message->userId());

        $mailMessage = \Swift_Message::newInstance('Welcome', 'Yes, welcome');
        $mailMessage->setTo((string) $user->getEmail());
        $this->mailer->send($mailMessage);
    }
}
