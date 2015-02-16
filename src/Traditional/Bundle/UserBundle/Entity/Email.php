<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Assert\Assertion;

class Email
{
    private $email;

    private function __construct($email)
    {
        Assertion::email($email);

        $this->email = $email;
    }

    public static function fromString($email)
    {
        return new self($email);
    }

    public function __toString()
    {
        return $this->email;
    }
}
