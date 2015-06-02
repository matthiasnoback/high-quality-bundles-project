<?php

namespace Traditional\Domain\Model;

use Traditional\Bundle\UserBundle\Entity\User;

interface UserRepository
{
    public function add(User $user);

    public function all();

    /**
     * @param $id
     * @return User
     */
    public function byId($id);
}
