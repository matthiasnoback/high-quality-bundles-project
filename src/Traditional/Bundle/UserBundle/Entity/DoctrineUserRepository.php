<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\Common\Persistence\ManagerRegistry;
use Rhumsaa\Uuid\Uuid;

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

    /**
     * @return string
     */
    public function nextIdentity()
    {
        return (string) Uuid::uuid4();
    }

    /**
     * @return User[]
     */
    public function findDutchUsers()
    {
        return $this
            ->doctrine
            ->getManager()
            ->getRepository('Traditional\Bundle\UserBundle\Entity\User')
            ->findBy(['country' => 'NL']);
    }

    public function add(User $user)
    {
        $this->doctrine->getManager()->persist($user);
    }
}
