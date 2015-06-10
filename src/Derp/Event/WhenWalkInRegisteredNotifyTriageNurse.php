<?php

namespace Derp\Event;

use Derp\Domain\PatientRepository;
use SimpleBus\Message\Message;
use SimpleBus\Message\Subscriber\MessageSubscriber;

class WhenWalkInRegisteredNotifyTriageNurse implements MessageSubscriber
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var PatientRepository
     */
    private $patientRepository;

    public function __construct(
        \Swift_Mailer $mailer,
        PatientRepository $patientRepository
    ) {
        $this->mailer = $mailer;
        $this->patientRepository = $patientRepository;
    }

    /**
     * @param WalkInRegistered $message
     * @return void
     */
    public function notify(Message $message)
    {
        $patient = $this->patientRepository->byId($message->patientId());

        $message = \Swift_Message::newInstance(
            'A new patient has walked in',
            'Indication: ' . $patient->getIndication()
        );
        $message->setTo('triage-nurse@derp.nl');
        $this->mailer->send($message);
    }
}
