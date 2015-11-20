<?php

namespace Derp\Domain\Model\Patient;

use Derp\Domain\Model\Patient\PatientId;
use Derp\Domain\Model\Patient\PersonalInformation;
use JMS\Serializer\Annotation as Serialize;

class WalkInRegistered
{
    /**
     * @var PatientId
     * @Serialize\Type("Derp\Domain\Model\Patient\PatientId")
     */
    private $patientId;
    /**
     * @var PersonalInformation
     * @Serialize\Type("Derp\Domain\Model\Patient\PersonalInformation")
     */
    private $personalInformation;

    /**
     * @Serialize\Type("string")
     */
    private $indication;

    /**
     * @param PatientId $patientId
     * @param PersonalInformation $personalInformation
     * @param $indication
     */
    public function __construct(PatientId $patientId, PersonalInformation $personalInformation, $indication)
    {
        $this->patientId = $patientId;
        $this->personalInformation = $personalInformation;
        $this->indication = $indication;
    }

    public function patientId()
    {
        return $this->patientId;
    }

    public function personalInformation()
    {
        return $this->personalInformation;
    }

    public function indication()
    {
        return $this->indication;
    }
}
