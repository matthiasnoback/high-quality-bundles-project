<?php

namespace Derp\Application;

use Derp\Bundle\ERBundle\Entity\BirthDate;
use Derp\Bundle\ERBundle\Entity\FullName;
use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\PatientId;
use Derp\Bundle\ERBundle\Entity\PatientRepository;
use Derp\Bundle\ERBundle\Entity\PersonalInformation;
use Derp\Bundle\ERBundle\Entity\Sex;

class RegisterWalkInHandler
{
    /**
     * @var PatientRepository
     */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function __invoke(RegisterWalkIn $command)
    {
        $patient = Patient::walkIn(
            PatientId::fromString($command->id),
            PersonalInformation::fromDetails(
                FullName::fromParts($command->firstName, $command->lastName),
                BirthDate::fromYearMonthDayFormat($command->dateOfBirth),
                new Sex($command->sex)
            ),
            $command->indication
        );

        $this->patientRepository->add($patient);
    }
}
