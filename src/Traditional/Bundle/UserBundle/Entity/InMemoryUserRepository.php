<?php

namespace Traditional\Bundle\UserBundle\Entity;

class InMemoryUserRepository implements UserRepository
{
    private $users = array();

    public function add(User $user)
    {
        $this->users[] = $user;
    }

    public function dutchUsers()
    {
        return array_filter($this->users, function (User $user) {
            return $user->getCountry() === 'NL';
        });
    }
}
