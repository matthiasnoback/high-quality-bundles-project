<?php

namespace Derp\Bundle\ERBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Pod
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Bed", mappedBy="pod", orphanRemoval=true, cascade={"persist", "remove"})
     * @ORM\JoinColumn(onDelete="cascade")
     */
    private $beds;
//
//    private function __construct($name)
//    {
//        $this->name = $name;
//        $this->beds = new ArrayCollection();
//    }
//
//    public static function assemble($name)
//    {
//        return new Pod($name);
//    }

    /**
     * compromise
     */
    public function __construct()
    {
        $this->beds = new ArrayCollection();
    }

    /**
     * compromise
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return PodId::fromString($this->id);
    }

    public function allocateBeds($numberOfBeds)
    {
        for ($i = 0; $i < $numberOfBeds; $i++) {
            $this->beds[] = new Bed($this);
        }
    }

    public function beds()
    {
        return $this->beds;
    }
}
