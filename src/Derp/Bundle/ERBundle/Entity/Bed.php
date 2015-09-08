<?php

namespace Derp\Bundle\ERBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Bed
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Pod", inversedBy="beds")
     */
    private $pod;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $patientId;

    public function __construct(Pod $pod)
    {
        $this->pod = $pod;
    }

    public function getId()
    {
        return $this->id;
    }

    public function reserveForPatient(PatientId $patientId)
    {
        $this->patientId = (string) $patientId;
    }

    public function patientId()
    {
        return PatientId::fromString($this->patientId);
    }
}
