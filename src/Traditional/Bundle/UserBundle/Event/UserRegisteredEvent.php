<?php

namespace Traditional\Bundle\UserBundle\Event;

use SimpleBus\Asynchronous\Message\HandleAsynchronously;
use SimpleBus\Message\Name\NamedMessage;
use JMS\Serializer\Annotation as Serializer;

class UserRegisteredEvent implements NamedMessage, HandleAsynchronously
{
    public static function messageName()
    {
        return 'user_registered';
    }

    /**
     * @Serializer\Type("integer")
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
