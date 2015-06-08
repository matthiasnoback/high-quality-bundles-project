<?php

namespace Derp\Bundle\ERBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Patient
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     */
    private $indication;

    /**
     * @ORM\Column(type="boolean")
     */
    private $arrived;

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getIndication()
    {
        return $this->indication;
    }

    public function setIndication($indication)
    {
        $this->indication = $indication;
    }

    public function getArrived()
    {
        return $this->arrived;
    }

    public function setArrived($arrived)
    {
        $this->arrived = $arrived;
    }
}
