<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\Common\Persistence\ManagerRegistry;

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
        $entityManager = $this->doctrine->getManagerForClass(User::class);
        $entityManager->persist($user);
    }

    public function dutchUsers()
    {
        return $this->doctrine
            ->getManagerForClass(User::class)
            ->getRepository('Traditional\Bundle\UserBundle\Entity\User')
            ->findBy(['country' => 'NL']);
    }
}
