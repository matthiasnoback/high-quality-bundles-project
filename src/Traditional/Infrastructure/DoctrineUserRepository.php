<?php

namespace Traditional\Infrastructure;

use Doctrine\Common\Persistence\ManagerRegistry;
use Traditional\Bundle\UserBundle\Entity\User;
use Traditional\Domain\Model\UserNotFound;
use Traditional\Domain\Model\UserRepository;

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

    public function all()
    {
        return $this->entityRepository()->findAll();
    }

    public function byId($id)
    {
        $user = $this->entityRepository()->find($id);
        if ($user === null) {
            throw new UserNotFound();
        }

        return $user;
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectManager
     */
    protected function entityManager()
    {
        return $this->doctrine->getManager();
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository
     */
    protected function entityRepository()
    {
        return $this->entityManager()->getRepository(User::class);
    }
}
