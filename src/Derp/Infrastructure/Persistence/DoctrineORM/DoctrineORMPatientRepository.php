<?php

namespace Derp\Infrastructure\Persistence\DoctrineORM;

use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\PatientId;
use Derp\Bundle\ERBundle\Entity\PatientNotFound;
use Derp\Bundle\ERBundle\Entity\PatientRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Rhumsaa\Uuid\Uuid;

class DoctrineORMPatientRepository implements PatientRepository
{
    /**
     * @var ManagerRegistry
     */
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function add(Patient $patient)
    {
        $em = $this->doctrine->getManager();
        $em->persist($patient);
    }

    /**
     * @return PatientId
     */
    public function nextIdentity()
    {
        return PatientId::fromString(Uuid::uuid4());
    }

    /**
     * @param PatientId $id
     * @return Patient
     * @throws PatientNotFound
     */
    public function getById(PatientId $id)
    {
        $patient = $this
            ->doctrine
            ->getManager()
            ->getRepository(Patient::class)
            ->find((string) $id);

        if ($patient === null) {
            throw new PatientNotFound();
        }

        return $patient;
    }
}
