<?php

namespace Traditional\Bundle\UserBundle\Entity;

class Country
{
    private $countryCode;

    public function __construct($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function isEqual(Country $country)
    {
        return $country->countryCode === $this->countryCode;
    }
}
