<?php

namespace Derp\Infrastructure\Persistence;

use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\PatientId;
use Derp\Bundle\ERBundle\Entity\PatientNotFound;
use Derp\Bundle\ERBundle\Entity\PatientRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Rhumsaa\Uuid\Uuid;

class DoctrinePatientRepository implements PatientRepository
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    public function add(Patient $patient)
    {
        $this->entityManager()
            ->persist($patient);
    }

    /**
     * @return EntityManager
     */
    private function entityManager()
    {
        return $this->managerRegistry
            ->getManagerForClass(Patient::class);
    }

    public function all()
    {
        return $this->entityRepository()
            ->findAll();
    }

    public function byLastName($lastName)
    {
        return $this->entityRepository()
            ->findBy(
                ['personalInformation.name.lastName' => $lastName]
            );
    }

    /**
     * @return EntityRepository
     */
    private function entityRepository()
    {
        return $this->managerRegistry
            ->getRepository(Patient::class);
    }

    public function byId($id)
    {
        $patient = $this->entityRepository()->find($id);

        if (!$patient instanceof Patient) {
            throw new PatientNotFound();
        }

        return $patient;
    }
}
