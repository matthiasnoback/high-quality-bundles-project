<?php

namespace Traditional\User\Domain\Model;

use Traditional\User\Domain;
use Traditional\User\Domain\Model\User;

interface UserRepository
{
    /**
     * @param User $user
     * @return void
     */
    public function add(Domain\Model\User $user);

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
