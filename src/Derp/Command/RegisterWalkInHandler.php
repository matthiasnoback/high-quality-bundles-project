<?php

namespace Derp\Command;

use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\PatientId;
use Derp\Bundle\ERBundle\Entity\PatientRepository;
use Derp\Bundle\ERBundle\Entity\PersonalInformation;
use Derp\Bundle\ERBundle\Entity\FullName;
use Derp\Bundle\ERBundle\Entity\BirthDate;
use Derp\Bundle\ERBundle\Entity\Sex;
use SimpleBus\Message\Handler\MessageHandler;
use SimpleBus\Message\Message;

class RegisterWalkInHandler implements MessageHandler
{
    /**
     * @var PatientRepository
     */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * @param RegisterWalkIn $command
     */
    public function handle(Message $command)
    {
        $patient = Patient::walkIn(
            PatientId::fromString($command->id),
            PersonalInformation::fromDetails(
                FullName::fromParts($command->firstName, $command->lastName),
                BirthDate::fromYearMonthDayFormat($command->dateOfBirth->format('Y-m-d')),
                new Sex($command->sex)
            ),
            $command->indication
        );

        $this->patientRepository->add($patient);
    }
}
