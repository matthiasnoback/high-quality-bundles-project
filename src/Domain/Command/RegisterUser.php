<?php

namespace Domain\Command;

use Rhumsaa\Uuid\Uuid;
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

    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }

    public static function messageName()
    {
        return 'register_user';
    }
}
