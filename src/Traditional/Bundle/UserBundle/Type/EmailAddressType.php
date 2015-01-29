<?php

namespace Traditional\Bundle\UserBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Traditional\Bundle\UserBundle\Entity\EmailAddress;

class EmailAddressType extends StringType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        if (!($value instanceof EmailAddress)) {
            throw new \LogicException('Expected an EmailAddress instance');
        }

        return (string) $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }

        return EmailAddress::fromString($value);
    }
}
