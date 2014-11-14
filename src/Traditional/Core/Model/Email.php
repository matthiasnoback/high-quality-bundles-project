<?php

namespace Traditional\Core\Model;

use Assert\Assertion;

class Email
{
    private $email;

    public static function fromString($email)
    {
        return new self($email);
    }

    private function __construct($email)
    {
        Assertion::email($email);

        $this->email = $email;
    }

    public function __toString()
    {
        return $this->email;
    }

    public function host()
    {
        return substr($this->email, strpos($this->email, '@') + 1);
    }
}
