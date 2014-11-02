<?php

namespace Traditional\Bundle\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="traditional_phonenumber")
 */
class PhoneNumber
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $countryCode;

    /**
     * @ORM\Column(type="string")
     */
    private $areaCode;

    /**
     * @ORM\Column(type="string")
     */
    private $lineNumber;

    /**
     * @ORM\ManyToOne(targetEntity="Traditional\Bundle\UserBundle\Entity\User")
     */
    private $user;

    public function getCountryCode()
    {
        return $this->countryCode;
    }

    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function getAreaCode()
    {
        return $this->areaCode;
    }

    public function setAreaCode($areaCode)
    {
        $this->areaCode = $areaCode;
    }

    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    public function setLineNumber($lineNumber)
    {
        $this->lineNumber = $lineNumber;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function __toString()
    {
        return $this->countryCode . ltrim($this->areaCode, '0') . $this->lineNumber;
    }
}
