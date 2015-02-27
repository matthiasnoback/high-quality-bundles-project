<?php

namespace SimpleBus\Asynchronous\Message\Dispatcher;

use SimpleBus\Asynchronous\Message\HandleAsynchronously;
use SimpleBus\Asynchronous\Message\Publisher\Publisher;
use SimpleBus\Asynchronous\Message\Serializer\MessageSerializer;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Message;

class AsynchronousEventDispatcher implements MessageBusMiddleware
{
    /**
     * @var MessageSerializer
     */
    private $serializer;

    /**
     * @var Publisher
     */
    private $publisher;

    public function __construct(MessageSerializer $serializer, Publisher $publisher)
    {
        $this->serializer = $serializer;
        $this->publisher = $publisher;
    }

    /**
     * Handle a Message by publishing it to a queue (if applicable)
     *
     * @{inheritdoc}
     */
    public function handle(Message $message, callable $next)
    {
        if ($message instanceof HandleAsynchronously) {
            $this->publisher->publish($message);
        } else {
            $next($message);
        }
    }
}
