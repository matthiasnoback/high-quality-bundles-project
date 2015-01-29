<?php

namespace Traditional\Bundle\UserBundle\Event;

use SimpleBus\Message\Bus\MessageBus;
use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;
use Traditional\Bundle\UserBundle\Command\SendWelcomeMail;

class WhenUserRegisteredSendWelcomeMail implements MessageSubscriber
{
    /**
     * @var MessageBus
     */
    private $commandBus;

    public function __construct(MessageBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function notify(Message $message)
    {
        if (!($message instanceof UserRegistered)) {
            throw new \LogicException();
        }

        $command = new SendWelcomeMail($message->user());
        $this->commandBus->handle($command);
    }
}
