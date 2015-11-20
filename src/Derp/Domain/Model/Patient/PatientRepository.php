<?php

namespace Derp\Domain\Model\Patient;

use Derp\Domain\Model\Patient\Patient;
use Derp\Domain\Model\Patient\PatientNotFound;

interface PatientRepository
{
    /**
     * @param Patient $patient
     * @return void
     */
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
     * @param string $id
     * @return Patient
     * @throws PatientNotFound
     */
    public function byId($id);
}
