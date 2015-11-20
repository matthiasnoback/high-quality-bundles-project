<?php

namespace Derp\Application;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterWalkIn
{
    /**
     * @Assert\NotBlank()
     */
    public $firstName;

    /**
     * @Assert\NotBlank()
     */
    public $lastName;

    /**
     * @Assert\Date()
     * @Assert\NotNull()
     */
    public $dateOfBirth;

    /**
     * @Assert\Choice(choices={"male", "female", "intersex"})
     * @Assert\NotNull()
     */
    public $sex;

    /**
     * @Assert\NotBlank()
     */
    public $indication;
}
