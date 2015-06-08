<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreatePatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('personalInformation', new PersonalInformationType())
            ->add('indication', 'textarea', ['label' => 'Indication', 'attr' => ['rows' => 5, 'cols' => 20]])
            ->add('arrived', 'checkbox', ['label' => 'Arrived?'])
            ->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class
        ]);
    }

    public function getName()
    {
        return 'create_patient';
    }
}
