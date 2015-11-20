<?php

namespace Derp\Application;

use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serialize;

class RegisterWalkIn
{
    /**
     * @Assert\NotBlank()
     * @Serialize\Type("string")
     * @Serialize\SerializedName("firstName")
     */
    public $firstName;

    /**
     * @Assert\NotBlank()
     * @Serialize\Type("string")
     * @Serialize\SerializedName("lastName")
     */
    public $lastName;

    /**
     * @Assert\Date()
     * @Assert\NotNull()
     * @Serialize\Type("string")
     * @Serialize\SerializedName("dateOfBirth")
     */
    public $dateOfBirth;

    /**
     * @Assert\Choice(choices={"male", "female", "intersex"})
     * @Assert\NotNull()
     * @Serialize\Type("string")
     */
    public $sex;

    /**
     * @Assert\NotBlank()
     * @Serialize\Type("string")
     */
    public $indication;

    /**
     * @Serialize\Type("string")
     */
    public $id;
}
