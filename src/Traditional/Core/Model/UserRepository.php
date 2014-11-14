<?php

namespace Traditional\Core\Model;

interface UserRepository
{
    /**
     * @return User[]
     */
    public function findAllUsersOrderedByCountry();

    /**
     * @return User
     * @throws \RuntimeException
     */
    public function getById($id);
}
