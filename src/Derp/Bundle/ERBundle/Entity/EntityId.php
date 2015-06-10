<?php

namespace Derp\Bundle\ERBundle\Entity;

use JMS\Serializer\Annotation as Serializer;

abstract class EntityId
{
    /**
     * @Serializer\Type("string")
     */
    private $id;

    private function __construct()
    {
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
