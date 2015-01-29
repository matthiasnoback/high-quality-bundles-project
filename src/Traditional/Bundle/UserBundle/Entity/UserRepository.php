<?php

namespace Traditional\Bundle\UserBundle\Entity;

interface UserRepository
{
    public function add(User $user);
}
