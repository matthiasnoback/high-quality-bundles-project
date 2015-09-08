<?php

namespace Derp\Bundle\ERBundle\Entity;

use Derp\Event\PatientHasWalkedIn;
use Doctrine\ORM\Mapping as ORM;
use SimpleBus\Message\Recorder\ContainsRecordedMessages;
use SimpleBus\Message\Recorder\PrivateMessageRecorderCapabilities;

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
     */
    private $indication;

    /**
     * @ORM\Column(type="boolean")
     */
    private $arrived;

    /**
     * @ORM\Embedded(class="PersonalInformation", columnPrefix=false)
     */
    private $personalInformation;

    private function __construct(PatientId $id, PersonalInformation $personalInformation, $indication, $arrived)
    {
        \Assert\that($indication)->string('Indication should be a string')->notEmpty('Indication should not be empty');
        $this->indication = $indication;
        $this->arrived = $arrived;
        $this->personalInformation = $personalInformation;
        $this->id = $id;
    }

    public static function walkIn(PatientId $id, PersonalInformation $personalInformation, $indication)
    {
        $patient = new Patient($id, $personalInformation, $indication, true);

        $event = new PatientHasWalkedIn($personalInformation, $indication);
        $patient->record($event);

        return $patient;
    }

//    public static function announce(PersonalInformation $personalInformation, $indication)
//    {
//        return new Patient($personalInformation, $indication, false);
//    }
//
//    public function registerArrival()
//    {
//        \Assert\that($this->arrived)->false('The patient already arrived');
//
//        $this->arrived = true;
//    }
//
//    public function hasArrived()
//    {
//        return $this->arrived;
//    }

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
