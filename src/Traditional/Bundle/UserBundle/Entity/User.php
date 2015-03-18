<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="traditional_user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string")
     */
    private $country;

    public function __construct(Email $email, $password, $country)
    {
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setCountry($country);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return Email::fromString($this->email);
    }

    private function setEmail(Email $email)
    {
        $this->email = (string) $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    private function setPassword($password)
    {
        $this->password = $password;
    }

    public function getCountry()
    {
        return $this->country;
    }

    private function setCountry($country)
    {
        $this->country = $country;
    }
}
