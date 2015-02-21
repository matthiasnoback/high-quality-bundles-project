<?php

namespace Traditional\Bundle\UserBundle\Command;

use Rhumsaa\Uuid\Uuid;
use SimpleBus\Message\Name\NamedMessage;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements NamedMessage
{
    private $id;

    /**
     * @Assert\Email
     */
    private $email;

    /**
     * @Assert\NotBlank
     */
    private $password;

    /**
     * @Assert\Country
     */
    private $country;

    public function __construct($email, $password, $country)
    {
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
    }

    public function id()
    {
        if ($this->id === null) {
            $this->id = Uuid::uuid4();
        }

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
