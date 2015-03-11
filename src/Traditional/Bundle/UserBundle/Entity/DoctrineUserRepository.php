<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;

class DoctrineUserRepository implements UserRepository
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function add(User $user)
    {
        $this->entityManager()->persist($user);
    }

    public function dutchUsers()
    {
        return $this->doctrine
            ->getManagerForClass(User::class)
            ->getRepository('Traditional\Bundle\UserBundle\Entity\User')
            ->findBy(['country' => 'NL']);
    }

    /**
     * @return User
     */
    public function byId($id)
    {
        $user = $this->entityManager()->find(User::class, $id);

        if (!$user) {
            throw new \LogicException();
        }

        return $user;
    }

    private function repository()
    {
        return $this->entityManager()->getRepository(User::class);
    }

    /**
     * @return EntityManager
     */
    private function entityManager()
    {
        return $this->doctrine->getManagerForClass(User::class);
    }

    public function all()
    {
        return $this->repository()->findAll();
    }
}
