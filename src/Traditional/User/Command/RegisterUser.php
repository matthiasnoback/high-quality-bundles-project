<?php

namespace Traditional\User\Command;

use Rhumsaa\Uuid\Uuid;
use SimpleBus\Message\Message;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements Message
{
    /**
     * @Assert\NotBlank
     * @Assert\Email
     */
    public $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=2)
     */
    public $password;

    /**
     * @Assert\NotBlank
     * @Assert\Country
     */
    public $country;

    private $id;

    public function getId()
    {
        if ($this->id === null) {
            $this->id = Uuid::uuid4();
        }

        return $this->id;
    }
}
