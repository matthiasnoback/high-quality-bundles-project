<?php

namespace Derp\Domain\Model\Patient;

use Rhumsaa\Uuid\Uuid;
use JMS\Serializer\Annotation as Serialize;

class PatientId
{
    /**
     * @Serialize\Type("string")
     */
    private $id;

    private function __construct()
    {
    }

    public static function generate()
    {
        return PatientId::fromString(
            (string) Uuid::uuid4()
        );
    }

    public static function fromString($string)
    {
        $patientId = new static();
        $patientId->id = $string;

        return $patientId;
    }

    public function __toString()
    {
        return (string) $this->id;
    }
}
