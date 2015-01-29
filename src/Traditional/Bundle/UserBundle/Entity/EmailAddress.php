<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Assert\Assertion;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class EmailAddress
{
    /**
     * @ORM\Column(type="string")
     */
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
