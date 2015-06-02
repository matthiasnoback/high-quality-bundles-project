<?php

namespace Traditional\Domain\Model;

use Assert\Assertion;
use Symfony\Component\Intl\Intl;

class Country
{
    private $countryCode;

    private function __construct($countryCode)
    {
        Assertion::string($countryCode);
        Assertion::notNull(Intl::getRegionBundle()->getCountryName($countryCode));

        $this->countryCode = $countryCode;
    }

    public static function fromCountryCode($countryCode)
    {
        return new self($countryCode);
    }

    public function name()
    {
        return Intl::getRegionBundle()->getCountryName($this->countryCode);
    }

    public function __toString()
    {
        return $this->countryCode;
    }
}
