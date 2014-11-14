<?php

namespace Traditional\Core\User\Register;

use SimpleBus\Command\Command;
use Symfony\Component\Validator\Constraints as Assert;
use Rhumsaa\Uuid\Uuid;

class RegisterUser implements Command
{
    /**
     * @Assert\NotBlank
     */
    private $id;

    /**
     * @Assert\Email
     * @Assert\NotNull
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
        $this->id = Uuid::uuid4();
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return 'register_user';
    }

    public function country()
    {
        return $this->country;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }
}
