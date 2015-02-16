<?php

namespace Traditional\Bundle\UserBundle\Event;

use Psr\Log\LoggerInterface;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;
use SimpleBus\Message\Message;

class LoggingMiddleware implements MessageBusMiddleware
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Message $message, callable $next)
    {
        $this->logger->debug('Start handling message of type "'.get_class($message).'"');
        $next($message);
        $this->logger->debug('Finished handling message of type "'.get_class($message).'"');
    }
}
