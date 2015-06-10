<?php

namespace Derp\Command;

use SimpleBus\Message\Message;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterWalkIn implements Message
{
    public $patientId;

    /**
     * @Assert\NotBlank()
     */
    public $firstName;

    /**
     * @Assert\NotBlank()
     */
    public $lastName;

    /**
     * @Assert\Choice(choices={"male", "female", "intersex"})
     */
    public $sex;

    /**
     * @var \DateTime
     */
    public $birthDate;

    /**
     * @Assert\NotBlank()
     */
    public $indication;
}
