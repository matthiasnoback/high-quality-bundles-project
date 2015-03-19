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

    /**
     * @param $id
     * @return User
     * @throws \DomainException
     */
    public function byId($id);
}
