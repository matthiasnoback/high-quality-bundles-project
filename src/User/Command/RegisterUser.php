<?php

namespace User\Command;

use Rhumsaa\Uuid\Uuid;
use SimpleBus\Message\Message;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;

class RegisterUser implements Message
{
    /**
     * @Assert\Email()
     * @Assert\NotNull()
     * @Serializer\Type("string")
     */
    public $email;

    /**
     * @Assert\Length(min=8)
     * @Assert\NotNull()
     * @Serializer\Type("string")
     */
    public $password;

    /**
     * @Assert\Country
     * @Assert\NotNull()
     * @Serializer\Type("string")
     * @var string
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
