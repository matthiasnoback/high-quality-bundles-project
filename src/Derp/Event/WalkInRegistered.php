<?php

namespace Derp\Event;

use Derp\Bundle\ERBundle\Entity\PatientId;
use SimpleBus\Message\Message;
use JMS\Serializer\Annotation as Serializer;

class WalkInRegistered implements Message
{
    /**
     * @var PatientId
     * @Serializer\Type("Derp\Bundle\ERBundle\Entity\PatientId")
     */
    private $patientId;

    public function __construct(PatientId $patientId)
    {
        $this->patientId = $patientId;
    }

    public function patientId()
    {
        return $this->patientId;
    }
}
