<?php

namespace Derp\Application;

use Derp\Domain\Model\Patient\BirthDate;
use Derp\Domain\Model\Patient\FullName;
use Derp\Domain\Model\Patient\Patient;
use Derp\Domain\Model\Patient\PatientId;
use Derp\Domain\Model\Patient\PatientRepository;
use Derp\Domain\Model\Patient\PersonalInformation;
use Derp\Domain\Model\Patient\Sex;

class RegisterWalkInHandler
{
    /**
     * @var \Derp\Domain\Model\Patient\PatientRepository
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
