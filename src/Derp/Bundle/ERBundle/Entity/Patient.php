<?php

namespace Derp\Bundle\ERBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
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
     * @Assert\Valid
     */
    private $personalInformation;
//
//    private function __construct(PersonalInformation $personalInformation, $indication, $arrived)
//    {
//        $this->indication = $indication;
//        $this->arrived = $arrived;
//        $this->personalInformation = $personalInformation;
//    }
//
//    public static function walkIn(PersonalInformation $personalInformation, $indication)
//    {
//        return new Patient($personalInformation, $indication, true);
//    }
//
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
        return $this->id;
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

    /**
     * compromise
     */
    public function setIndication($indication)
    {
        $this->indication = $indication;
    }

    /**
     * compromise
     */
    public function setArrived($arrived)
    {
        $this->arrived = $arrived;
    }

    /**
     * compromise
     */
    public function setPersonalInformation(PersonalInformation $personalInformation)
    {
        $this->personalInformation = $personalInformation;
    }
}
