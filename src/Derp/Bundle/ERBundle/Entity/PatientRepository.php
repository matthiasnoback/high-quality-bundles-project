<?php

namespace Derp\Bundle\ERBundle\Entity;

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
