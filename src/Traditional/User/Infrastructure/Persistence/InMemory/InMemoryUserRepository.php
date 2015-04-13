<?php

namespace Traditional\User\Infrastructure\Persistence\InMemory;

use Traditional\User\Domain\Model\User;
use Traditional\User\Domain\Model\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private $users = [];

    public function add(User $user)
    {
        $this->users[] = $user;
    }

    public function all()
    {
        return $this->users;
    }
}
