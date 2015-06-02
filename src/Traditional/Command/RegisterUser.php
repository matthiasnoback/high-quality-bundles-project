<?php

namespace Traditional\Command;

use Rhumsaa\Uuid\Uuid;
use SimpleBus\Message\Message;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements Message
{
    private $id;

    public function id()
    {
        if ($this->id === null) {
            $this->id = Uuid::uuid4();
        }

        return $this->id;
    }

    /**
     * @Assert\NotNull()
     * @Assert\Email()
     */
    public $email;

    /**
     * @Assert\NotNull()
     * @Assert\Length(min=4)
     */
    public $password;

    /**
     * @Assert\NotNull()
     * @Assert\Country()
     */
    public $country;
}
