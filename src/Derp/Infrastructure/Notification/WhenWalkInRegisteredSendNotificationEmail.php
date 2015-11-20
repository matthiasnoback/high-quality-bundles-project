<?php

namespace Derp\Infrastructure\Notification;

use Derp\Bundle\ERBundle\Entity\WalkInRegistered;

class WhenWalkInRegisteredSendNotificationEmail
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function __invoke(WalkInRegistered $event)
    {
        $message = \Swift_Message::newInstance(
            'New patient',
            'Indication: ' . $event->indication()
        );
        $message->setTo('triage-nurse@derp.nl');
        $this->mailer->send($message);
    }
}
