<?php

namespace User\Domain\Model;

use Traditional\Bundle\UserBundle\Entity\User;

interface UserRepository
{
    public function add(User $user);

    /**
     * @return User[]
     */
    public function findAll();

    /**
     * @param $id
     * @return User
     * @throws \DomainException
     */
    public function byId($id);
}
