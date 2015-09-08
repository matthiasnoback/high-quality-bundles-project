<?php

namespace Derp\Bundle\ERBundle\Entity;

interface PatientRepository
{
    public function add(Patient $patient);

    /**
     * @return PatientId
     */
    public function nextIdentity();

    /**
     * @param PatientId $id
     * @return Patient
     * @throws PatientNotFound
     */
    public function getById(PatientId $id);
}
