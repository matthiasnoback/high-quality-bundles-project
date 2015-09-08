<?php

namespace Derp\Event;

use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenPatientHasWalkedInSendEmail implements MessageSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Provide the given message as a notification to this subscriber
     *
     * @param PatientHasWalkedIn $event
     * @return void
     */
    public function notify(Message $event)
    {
        $emailMessage = \Swift_Message::newInstance(
            'A new patient has walked in',
            'Indication: ' . $event->indication()
        );
        $emailMessage->setTo('triage-nurse@derp.nl');
        $this->mailer->send($emailMessage);
    }
}
