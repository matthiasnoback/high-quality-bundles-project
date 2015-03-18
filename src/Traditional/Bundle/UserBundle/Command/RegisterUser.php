<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Name\NamedMessage;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements NamedMessage
{
    /**
     * @Assert\NotNull
     * @Assert\Email
     */
    public $email;
    public $password;
    public $country;

    public static function messageName()
    {
        return 'register_user';
    }
}
