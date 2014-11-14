<?php

namespace Traditional\Core\Model;

/**
 * Fake value object
 */
class UserPhoneNumber
{
    private $id;

    private $user;

    private $phoneNumber;

    public function __construct(PhoneNumber $phoneNumber, User $user)
    {
        $this->phoneNumber = $phoneNumber;
        $this->user = $user;
    }

    public function phoneNumber()
    {
        return $this->phoneNumber;
    }

    public function getId()
    {
        return $this->id;
    }
}
