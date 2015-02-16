<?php

namespace Traditional\Bundle\UserBundle\Entity;

class InMemoryUserRepository implements UserRepository
{
    private $users;

    public function add(User $user)
    {
        $this->users[] = $user;
    }

    /**
     * @return string
     */
    public function nextIdentity()
    {
        return mt_rand();
    }

    /**
     * @return User[]
     */
    public function findDutchUsers()
    {
        return array_filter($this->users, function (User $user) {
            return $user->getCountry() === 'NL';
        });
    }
}
