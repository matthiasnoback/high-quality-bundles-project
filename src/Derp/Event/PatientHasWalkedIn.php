<?php

namespace Derp\Event;

use Derp\Bundle\ERBundle\Entity\PersonalInformation;
use SimpleBus\Message\Message;

class PatientHasWalkedIn implements Message
{
    /**
     * @var PersonalInformation
     */
    private $personalInformation;

    /**
     * @var string
     */
    private $indication;

    public function __construct(PersonalInformation $personalInformation, $indication)
    {
        $this->personalInformation = $personalInformation;
        $this->indication = $indication;
    }

    public function indication()
    {
        return $this->indication;
    }

    public function personalInformation()
    {
        return $this->personalInformation;
    }
}
