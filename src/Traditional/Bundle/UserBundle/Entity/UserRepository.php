<?php

namespace Traditional\Bundle\UserBundle\Entity;

interface UserRepository
{
    public function add(User $user);

    public function dutchUsers();

    public function all();

    /**
     * @return User
     */
    public function byId($id);
}
