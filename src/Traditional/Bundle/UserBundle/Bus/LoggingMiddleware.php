<?php

namespace Traditional\Bundle\UserBundle\Bus;

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
        $type = get_class($message);

        $this->logger->debug('Start handling message', ['type' => $type]);

        $next($message);

        $this->logger->debug('Finished handling message', ['type' => $type]);
    }
}
