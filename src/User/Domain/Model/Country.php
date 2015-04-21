<?php

namespace User\Domain\Model;

use Symfony\Component\Intl\Intl;

class Country
{
    private $countryCode;

    private function __construct($countryCode)
    {
        $countryName = self::countryNameForCountryCode($countryCode);

        \Assert\that($countryName)->notNull();

        $this->countryCode = $countryCode;
    }

    public static function fromCountryCode($countryCode)
    {
        return new self($countryCode);
    }

    public function name()
    {
        return self::countryNameForCountryCode($this->countryCode);
    }

    public function __toString()
    {
        return $this->countryCode;
    }

    private static function countryNameForCountryCode($countryCode)
    {
        return Intl::getRegionBundle()->getCountryName($countryCode);
    }
}
