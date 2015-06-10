<?php

namespace Derp\Infrastructure;

use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\PatientId;
use Derp\Domain\PatientNotFound;
use Derp\Domain\PatientRepository;
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

    public function all()
    {
        return $this
            ->doctrine
            ->getManager()
            ->getRepository(Patient::class)
            ->findAll();
    }

    /**
     * @param string $lastName
     * @return Patient[]
     */
    public function byLastName($lastName)
    {
        return $this
            ->doctrine
            ->getManager()
            ->getRepository(Patient::class)
            ->findBy(
                ['personalInformation.name.lastName' => $lastName]
            );
    }

    /**
     * @param $id
     * @return Patient
     */
    public function byId($id)
    {
        $patient = $this
            ->doctrine
            ->getManager()
            ->getRepository(Patient::class)
            ->find($id);

        if ($patient === null) {
            throw new PatientNotFound();
        }

        return $patient;
    }

    /**
     * @return PatientId
     */
    public function nextIdentity()
    {
        return PatientId::fromString(Uuid::uuid4()->toString());
    }
}
