<?php

namespace Derp\Bundle\ERBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreatePatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('personalInformation', new PersonalInformationType())
            ->add('indication', 'text', ['label' => 'Indication'])
            ->add('arrived', 'checkbox', ['label' => 'Arrived?'])
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'create_patient';
    }
}
