<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class EmailType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if (!($value instanceof Email)) {
            throw new \UnexpectedValueException();
        }

        return (string) $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        return Email::fromString($value);
    }

    public function getName()
    {
        return 'email';
    }
}
