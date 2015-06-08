<?php

namespace Derp\Bundle\ERBundle\Entity;

abstract class EntityId
{
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
