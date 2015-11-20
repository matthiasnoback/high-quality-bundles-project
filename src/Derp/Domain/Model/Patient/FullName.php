<?php

namespace Derp\Domain\Model\Patient;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serialize;

/**
 * @ORM\Embeddable()
 */
class FullName
{
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serialize\Type("string")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Serialize\Type("string")
     */
    private $lastName;

    private function __construct()
    {
    }

    public static function fromParts($firstName, $lastName)
    {
        $patient = new static();
        $patient->firstName = $firstName;
        $patient->lastName = $lastName;

        return $patient;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}
