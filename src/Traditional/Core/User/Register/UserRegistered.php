<?php

namespace Traditional\Core\User\Register;

use SimpleBus\Event\Event;
use Traditional\Core\Model\User;

class UserRegistered implements Event
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }

    public function name()
    {
        return 'user_registered';
    }
}
