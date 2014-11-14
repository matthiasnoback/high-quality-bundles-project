<?php

namespace Traditional\Infrastructure\Persistence\DoctrineORM;

use Doctrine\ORM\EntityRepository;
use Traditional\Core\Model\User;
use Traditional\Core\Model\UserRepository as UserRepositoryContract;

class UserRepository extends EntityRepository implements UserRepositoryContract
{
    public function findAllUsersOrderedByCountry()
    {
        return $this
            ->createQueryBuilder('u')
            ->orderBy('u.country', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return User
     * @throws \RuntimeException
     */
    public function getById($id)
    {
        $user = $this->find($id);

        if (!($user instanceof User)) {
            throw new \RuntimeException('User not found');
        }

        return $user;
    }
}
