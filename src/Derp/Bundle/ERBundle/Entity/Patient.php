<?php

namespace Derp\Bundle\ERBundle\Entity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Patient implements ContainsRecordedMessages
{
    use PrivateMessageRecorderCapabilities;

    /**
     * @ORM\Id()
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $indication;

    /**
     * @ORM\Column(type="boolean")
     */
    private $arrived;

    /**
     * @ORM\Embedded(class="PersonalInformation", columnPrefix=false)
     * @Assert\Valid()
     */
    private $personalInformation;

    private function __construct(PatientId $patientId, PersonalInformation $personalInformation, $indication, $arrived)
    {
        $this->id = (string) $patientId;
        Assertion::string($indication);
        Assertion::notEmpty($indication);
        $this->indication = $indication;

        Assertion::boolean($arrived);
        $this->arrived = $arrived;

        $this->personalInformation = $personalInformation;
    }

    public static function walkIn(PatientId $patientId, PersonalInformation $personalInformation, $indication)
    {
        $patient = new Patient($patientId, $personalInformation, $indication, true);

        $patient->record(new WalkInRegistered($patientId, $personalInformation, $indication));

        return $patient;
    }

    public static function announce(PatientId $patientId, PersonalInformation $personalInformation, $indication)
    {
        return new Patient($patientId, $personalInformation, $indication, false);
    }

    public function registerArrival()
    {
        \Assert\that($this->arrived)->false('The patient already arrived');

        $this->arrived = true;
    }

    public function getId()
    {
        return PatientId::fromString($this->id);
    }

    public function getIndication()
    {
        return $this->indication;
    }

    public function hasArrived()
    {
        return $this->arrived;
    }

    public function getPersonalInformation()
    {
        return $this->personalInformation;
    }
}
