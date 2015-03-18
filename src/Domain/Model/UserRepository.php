<?php

namespace Domain\Model;

interface UserRepository
{
    public function nextIdentity();

    public function add(User $user);

    /**
     * @return User[]
     */
    public function all();
}
