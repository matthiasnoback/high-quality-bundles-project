<?php

namespace Traditional\Bundle\UserBundle\Entity;

interface UserRepository
{
    /**
     * @return string
     */
    public function nextIdentity();

    public function add(User $user);

    /**
     * @return User[]
     */
    public function findDutchUsers();
}
