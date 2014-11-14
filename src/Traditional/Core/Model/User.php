<?php

namespace Traditional\Core\Model;

use Assert\Assertion;
use Doctrine\Common\Collections\ArrayCollection;
use Rhumsaa\Uuid\Uuid;
use SimpleBus\Event\Provider\EventProviderCapabilities;
use SimpleBus\Event\Provider\ProvidesEvents;
use Traditional\Core\User\Register\UserRegistered;

class User implements ProvidesEvents
{
    use EventProviderCapabilities;

    private $id;

    private $email;

    private $password;

    private $country;

    private $phoneNumbers;

    public function __construct(Uuid $id, Email $email, $password, $country)
    {
        $this->setId($id);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setCountry($country);

        $this->phoneNumbers = new ArrayCollection();

        $this->raise(new UserRegistered($this));
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @return PhoneNumber[]
     */
    public function getPhoneNumbers()
    {
        return $this->phoneNumbers
            ->map(
                function (UserPhoneNumber $userPhoneNumber) {
                    return $userPhoneNumber->phoneNumber();
                }
            )
            ->toArray();
    }

    public function addPhoneNumber(PhoneNumber $phoneNumber)
    {
        $this->phoneNumbers->add(new UserPhoneNumber($phoneNumber, $this));
    }

    private function setEmail(Email $email)
    {
        $this->email = $email;
    }

    private function setCountry($country)
    {
        Assertion::string($country);
        Assertion::notEmpty($country);

        $this->country = $country;
    }

    private function setPassword($password)
    {
        Assertion::string($password);
        Assertion::notEmpty($password);

        $this->password = $password;
    }

    private function setId(Uuid $id)
    {
        $this->id = $id;
    }
}
