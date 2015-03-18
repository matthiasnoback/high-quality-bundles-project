<?php

namespace Domain\Model;

use Domain\Model\User;

interface UserRepository
{
    public function add(User $user);

    /**
     * @return User[]
     */
    public function all();
}
