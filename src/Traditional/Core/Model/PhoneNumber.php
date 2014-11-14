<?php

namespace Traditional\Core\Model;

class PhoneNumber
{
    private $countryCode;

    private $areaCode;

    private $lineNumber;

    public function __construct($countryCode, $areaCode, $lineNumber)
    {
        $this->setCountryCode($countryCode);
        $this->setAreaCode($areaCode);
        $this->setLineNumber($lineNumber);
    }

    public function __toString()
    {
        return $this->countryCode . ltrim($this->areaCode, '0') . $this->lineNumber;
    }

    private function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    private function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
    }

    private function setLineNumber($lineNumber)
    {
        $this->lineNumber = $lineNumber;
    }
}
