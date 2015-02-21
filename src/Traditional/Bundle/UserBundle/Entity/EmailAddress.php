<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Assert\Assertion;

class EmailAddress
{
    private $emailAddress;

    private function __construct($emailAddress)
    {
        Assertion::email($emailAddress);

        $this->emailAddress = $emailAddress;
    }

    public static function fromString($emailAddress)
    {
        return new self($emailAddress);
    }

    public function __toString()
    {
        return $this->emailAddress;
    }
}
