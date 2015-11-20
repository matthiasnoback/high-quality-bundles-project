<?php

namespace Derp\Domain\Model\Patient;

use Derp\Domain\Model\Patient\Sex;
use Derp\Domain\Model\Patient\BirthDate;
use Derp\Domain\Model\Patient\FullName;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serialize;

/**
 * @ORM\Embeddable()
 */
class PersonalInformation
{
    /**
     * @ORM\Embedded(class="FullName", columnPrefix=false)
     * @Assert\Valid()
     * @Serialize\Type("Derp\Domain\Model\Patient\FullName")
     * @var FullName
     */
    private $name;

    /**
     * @ORM\Embedded(class="BirthDate", columnPrefix=false)
     * @Assert\Valid()
     * @Serialize\Type("Derp\Domain\Model\Patient\BirthDate")
     * @var BirthDate
     */
    private $dateOfBirth;

    /**
     * @ORM\Embedded(class="Sex", columnPrefix=false)
     * @Assert\Valid()
     * @Serialize\Type("Derp\Domain\Model\Patient\Sex")
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

    /**
     * @param Sex $sex
     * @param int $estimatedAge
     * @return static
     */
    public static function anonymous(Sex $sex, $estimatedAge)
    {
        $name = FullName::fromParts('John', 'Doe');
        if ($sex->isFemale()) {
            $name = FullName::fromParts('Jane', 'Doe');
        }

        return new static(
            $name,
            BirthDate::fromEstimatedAge($estimatedAge),
            $sex
        );
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
