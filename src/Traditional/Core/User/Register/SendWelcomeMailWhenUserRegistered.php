<?php

namespace Traditional\Core\User\Register;

use SimpleBus\Command\Bus\CommandBus;
use SimpleBus\Event\Event;
use SimpleBus\Event\Handler\EventHandler;

class SendWelcomeMailWhenUserRegistered implements EventHandler
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param UserRegistered $event
     */
    public function handle(Event $event)
    {
        $this->commandBus->handle(new SendWelcomeMail($event->user()->getId()));
    }
}
