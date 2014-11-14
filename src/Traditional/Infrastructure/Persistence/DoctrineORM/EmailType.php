<?php

namespace Traditional\Infrastructure\Persistence\DoctrineORM;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Traditional\Core\Model\Email;

class EmailType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof Email) {
            return (string) $value;
        }

        throw new \UnexpectedValueException();
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return $value;
        }

        if (is_string($value)) {
            return Email::fromString($value);
        }

        throw new \UnexpectedValueException();
    }
}
