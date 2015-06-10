<?php

namespace Derp\Domain;

use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\PatientId;

interface PatientRepository
{
    public function add(Patient $patient);

    /**
     * @return Patient[]
     */
    public function all();

    /**
     * @param string $lastName
     * @return Patient[]
     */
    public function byLastName($lastName);

    /**
     * @param $id
     * @return Patient
     * @throws PatientNotFound
     */
    public function byId($id);

    /**
     * @return PatientId
     */
    public function nextIdentity();
}
