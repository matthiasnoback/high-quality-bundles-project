<?php

namespace Traditional\Bundle\UserBundle\Entity;

class Email
{
    /**
     * @var string
     */
    private $email;

    private function __construct($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException('Invalid email');
        }

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
