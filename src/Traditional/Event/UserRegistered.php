<?php

namespace Traditional\Event;

use JMS\Serializer\Annotation\Type;
use SimpleBus\Message\Message;

class UserRegistered implements Message
{
    /**
     * @Type("string")
     */
    private $userId;

    public function __construct($id)
    {
        $this->userId = $id;
    }

    public function userId()
    {
        return $this->userId;
    }
}
