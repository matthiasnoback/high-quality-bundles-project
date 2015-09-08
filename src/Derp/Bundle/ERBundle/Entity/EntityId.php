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
        \Assert\that($string)->uuid();

        $entityId = new static();
        $entityId->id = $string;

        return $entityId;
    }

    public function __toString()
    {
        return (string) $this->id;
    }
}
