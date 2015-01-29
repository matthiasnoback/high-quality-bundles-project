<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
    }
}
