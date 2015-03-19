<?php

namespace Domain\Event;

use SimpleBus\Message\Name\NamedMessage;
use JMS\Serializer\Annotation as Serializer;

class UserWasRegistered implements NamedMessage
{
    /**
     * @Serializer\Type("string")
     */
    private $userId;

    public function __construct($userId)
    {
        $this->userId = (string) $userId;
    }

    public function userId()
    {
        return $this->userId;
    }

    public static function messageName()
    {
        return 'user_was_registered';
    }
}
