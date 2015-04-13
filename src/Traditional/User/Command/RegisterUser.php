<?php

namespace Traditional\User\Command;

use Rhumsaa\Uuid\Uuid;
use SimpleBus\Message\Message;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

class RegisterUser implements Message
{
    /**
     * @Assert\NotBlank
     * @Assert\Email
     * @Serializer\Type("string")
     */
    public $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(min=2)
     * @Serializer\Type("string")
     */
    public $password;

    /**
     * @Assert\NotBlank
     * @Assert\Country
     * @Serializer\Type("string")
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
