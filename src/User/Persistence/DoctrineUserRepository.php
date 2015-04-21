<?php

namespace User\Persistence;

use Doctrine\Common\Persistence\ManagerRegistry;
use Traditional\Bundle\UserBundle\Entity\User;
use User\Domain\Model\UserRepository;

class DoctrineUserRepository implements UserRepository
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function add(User $user)
    {
        $this->entityManager()->persist($user);
    }

    public function findAll()
    {
        return $this->entityRepository()->findAll();
    }

    /**
     * @param $id
     * @return User
     * @throws \DomainException
     */
    public function byId($id)
    {
        $user = $this->entityRepository()->find($id);
        if ($user === null) {
            throw new \DomainException('User not found');
        }

        return $user;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    private function entityManager()
    {
        return $this->doctrine->getManager();
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    private function entityRepository()
    {
        return $this->entityManager()->getRepository(User::class);
    }
}
