<?php

namespace Derp\Bundle\ERBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Embeddable()
 */
class PersonalInformation
{
    /**
     * @ORM\Embedded(class="FullName", columnPrefix=false)
     * @Assert\Valid()
     * @var FullName
     */
    private $name;

    /**
     * @ORM\Embedded(class="BirthDate", columnPrefix=false)
     * @Assert\Valid()
     * @var BirthDate
     */
    private $dateOfBirth;

    /**
     * @ORM\Embedded(class="Sex", columnPrefix=false)
     * @Assert\Valid()
     * @var Sex
     */
    private $sex;

    /**
     * @param FullName $name
     * @param BirthDate $dateOfBirth
     * @param Sex $sex
     */
    private function __construct(FullName $name, BirthDate $dateOfBirth, Sex $sex)
    {
        $this->name = $name;
        $this->dateOfBirth = $dateOfBirth;
        $this->sex = $sex;
    }

    /**
     * @param FullName $name
     * @param BirthDate $date
     * @param Sex $sex
     * @return static
     */
    public static function fromDetails(FullName $name, BirthDate $date, Sex $sex)
    {
        return new static($name, $date, $sex);
    }

//    /**
//     * @param Sex $sex
//     * @param int $estimatedAge
//     * @return static
//     */
//    public static function anonymous(Sex $sex, $estimatedAge)
//    {
//        $name = FullName::fromParts('John', 'Doe');
//        if ($sex->isFemale()) {
//            $name = FullName::fromParts('Jane', 'Doe');
//        }
//
//        return new static(
//            $name,
//            BirthDate::fromEstimatedAge($estimatedAge),
//            $sex
//        );
//    }

    /**
     * compromise
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * compromise
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;
    }

    /**
     * compromise
     */
    public function setSex($sex)
    {
        $this->sex = $sex;
    }

    /**
     * @return FullName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return BirthDate
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * @return Sex
     */
    public function getSex()
    {
        return $this->sex;
    }
}
