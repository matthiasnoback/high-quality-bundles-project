<?php

namespace Traditional\Bundle\UserBundle\Controller\Rest;

use Traditional\User\Domain\Model\User;

class UserSummary
{
    private $id;

    private $email;

    private $country;

    public static function fromEntity(User $user)
    {
        $userSummary = new self();
        $userSummary->id = (string) $user->getId();
        $userSummary->email = (string) $user->getEmail();
        $userSummary->country = $user->getCountry();

        return $userSummary;
    }
}
