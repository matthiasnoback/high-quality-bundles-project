<?php

namespace Derp\Bundle\ERBundle\Entity;

class WalkInRegistered
{
    /**
     * @var PatientId
     */
    private $patientId;
    /**
     * @var PersonalInformation
     */
    private $personalInformation;
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
