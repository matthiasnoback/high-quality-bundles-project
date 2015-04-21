<?php

namespace User\Event;

use SimpleBus\Message\Message;
use JMS\Serializer\Annotation as Serializer;

class UserWasRegistered implements Message
{
    /**
     * @Serializer\Type("string")
     */
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function userId()
    {
        return $this->id;
    }
}
