<?php

namespace Traditional\User\Domain\Event;

use SimpleBus\Message\Message;
use Traditional\User\Domain;
use Traditional\User\Domain\Model\User;

class UserRegistered implements Message
{
    /**
     * @var User
     */
    private $user;

    public function __construct(Domain\Model\User $user)
    {
        $this->user = $user;
    }

    public function user()
    {
        return $this->user;
    }

    public function userEmail()
    {
        return $this->user->getEmail();
    }
}
