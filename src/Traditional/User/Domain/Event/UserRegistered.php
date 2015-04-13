<?php

namespace Traditional\User\Domain\Event;

use SimpleBus\Message\Message;
use Traditional\User\Domain;
use JMS\Serializer\Annotation as Serializer;

class UserRegistered implements Message
{
    /**
     * @Serializer\Type("string")
     */
    private $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    public function userId()
    {
        return $this->userId;
    }
}
