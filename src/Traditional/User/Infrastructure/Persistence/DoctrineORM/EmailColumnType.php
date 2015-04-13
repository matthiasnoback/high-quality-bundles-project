<?php

namespace Traditional\User\Infrastructure\Persistence\DoctrineORM;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;
use Traditional\User\Domain\Model\Email;

class EmailColumnType extends StringType
{
    public function getName()
    {
        return 'email';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if ($value instanceof Email) {
            return (string) $value;
        }

        throw new ConversionException('Unexpected value');
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            return Email::fromString($value);
        }

        throw new ConversionException('Unexpected value');
    }
}
