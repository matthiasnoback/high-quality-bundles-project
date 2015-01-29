<?php

namespace Traditional\Bundle\UserBundle\Event;

use SimpleBus\Message\Name\NamedMessage;
use SimpleBus\Message\Type\Event;
use Traditional\Bundle\UserBundle\Entity\User;

class UserRegistered implements Event, NamedMessage
{
    public static function messageName()
    {
        return 'user_registered';
    }

    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }
}
