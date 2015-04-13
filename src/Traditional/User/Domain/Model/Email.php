<?php

namespace Traditional\User\Domain\Model;

use Assert\Assertion;

class Email
{
    private $email;

    private function __construct($email)
    {
        Assertion::email($email);
        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }

    public static function fromString($email)
    {
        return new self($email);
    }
}
