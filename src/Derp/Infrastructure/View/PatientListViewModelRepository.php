<?php

namespace Derp\Infrastructure\View;

use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\PatientRepository;

class PatientListViewModelRepository
{
    /**
     * @var PatientRepository
     */
    private $patientRepository;

    public function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    public function all()
    {
        $allPatients = $this->patientRepository->all();

        return array_map(function (Patient $patient) {
            $patientListView = new PatientListView();
            $patientListView->id = $patient->getId();
            $patientListView->name =
                $patient->getPersonalInformation()->getName()->getFirstName() . ' ' .
                $patient->getPersonalInformation()->getName()->getLastName();
            $patientListView->hasArrived = $patient->hasArrived() ? 'yes' : 'no';
            $patientListView->sex = $patient->getPersonalInformation()->getSex()->getSex();

            return $patientListView;
        }, $allPatients);
    }
}
