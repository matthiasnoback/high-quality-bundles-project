<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Name\NamedMessage;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

class RegisterUser implements NamedMessage
{
    /**
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    public $id;

    /**
     * @Assert\Email
     * @Serializer\Type("string")
     */
    public $email;

    /**
     * @Assert\NotBlank
     * @Serializer\Type("string")
     */
    public $password;

    /**
     * @Assert\Country
     * @Serializer\Type("string")
     */
    public $country;

    public static function messageName()
    {
        return 'register_user';
    }
}
