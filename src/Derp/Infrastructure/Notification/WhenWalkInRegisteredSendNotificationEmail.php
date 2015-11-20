<?php

namespace Derp\Infrastructure\Notification;

use Derp\Bundle\ERBundle\Entity\WalkInRegistered;
use Psr\Log\LoggerInterface;

class WhenWalkInRegisteredSendNotificationEmail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(\Swift_Mailer $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function __invoke(WalkInRegistered $event)
    {
        $this->logger->debug('Sending email', ['indication' => $event->indication()]);

        $message = \Swift_Message::newInstance(
            'New patient',
            'Indication: ' . $event->indication()
        );
        $message->setTo('triage-nurse@derp.nl');
        $this->mailer->send($message);
    }
}
