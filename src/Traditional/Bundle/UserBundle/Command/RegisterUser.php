<?php

namespace Traditional\Bundle\UserBundle\Command;

use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\Message\Type\Command;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements Command, NamedMessage
{
    private $id;

    /**
     * @Assert\NotNull
     * @Assert\Email
     */
    private $email;

    /**
     * @Assert\NotNull
     * @Assert\Length(min=2)
     */
    private $password;

    /**
     * @Assert\NotNull
     * @Assert\Country
     */
    private $country;

    public function __construct($id, $email, $password, $country)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
    }

    public function id()
    {
        return $this->id;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function country()
    {
        return $this->country;
    }

    public static function messageName()
    {
        return 'register_user';
    }
}
