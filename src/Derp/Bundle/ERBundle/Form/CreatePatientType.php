<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Application\RegisterWalkIn;
use Derp\Bundle\ERBundle\Entity\Sex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', ['label' => 'First name (if you don\'t know: John, Jane, ...)'])
            ->add('lastName', 'text', ['label' => 'Last name (if you don\'t know: Doe, Roe, ...)'])
            ->add(
                'dateOfBirth',
                'date',
                [
                    'label' => 'Date of birth (if you don\'t know, guess)',
                    'years' => range(date('Y'), date('Y') - 120),
                    'input' => 'string'
                ]
            )
            ->add(
                'sex',
                'choice',
                [
                    'choices' => [
                        Sex::MALE => 'Male',
                        Sex::FEMALE => 'Female',
                        Sex::INTERSEX => 'Intersex'
                    ]
                ]
            )
            ->add('indication', 'textarea', ['label' => 'Indication', 'attr' => ['rows' => 5, 'cols' => 20]])
            ->add('submit', 'submit');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterWalkIn::class
        ]);
    }

    public function getName()
    {
        return 'create_patient';
    }
}
