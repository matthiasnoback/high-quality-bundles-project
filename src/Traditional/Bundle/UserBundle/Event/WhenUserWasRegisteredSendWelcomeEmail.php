<?php

namespace Traditional\Bundle\UserBundle\Event;

use Doctrine\ORM\EntityRepository;
use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenUserWasRegisteredSendWelcomeEmail implements MessageSubscriber
{
    /**
     * @var EntityRepository
     */
    private $userRepository;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(
        EntityRepository $userRepository,
        \Swift_Mailer $mailer
    ) {
        $this->userRepository = $userRepository;
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
