<?php

namespace Infrastructure\Persistence\Doctrine;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use Domain\Model\User;
use Domain\Model\UserRepository;

class DoctrineUserRepository implements UserRepository
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function add(User $user)
    {
        $this->doctrine
            ->getManagerForClass(User::class)
            ->persist($user);
    }

    /**
     * @return \Domain\Model\User[]
     */
    public function all()
    {
        return $this->userRepository()->findAll();
    }

    /**
     * @return EntityRepository
     */
    private function userRepository()
    {
        return $this->doctrine->getRepository(User::class);
    }
}
