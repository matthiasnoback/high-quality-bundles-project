<?php

namespace Infrastructure\Persistence\InMemory;

use Domain\Model\User;
use Domain\Model\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private $users = [];

    public function all()
    {
        return $this->users;
    }

    public function add(User $user)
    {
        $this->users[] = $user;
    }
}
