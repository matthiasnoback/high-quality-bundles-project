<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\Sex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterWalkInType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', ['label' => 'First name'])
            ->add('lastName', 'text', ['label' => 'Last name'])
            ->add(
                'sex',
                'choice',
                [
                    'choices' => [Sex::MALE => 'Male', Sex::FEMALE => 'Female', Sex::INTERSEX => 'Intersex']
                ]
            )
            ->add(
                'dateOfBirth',
                'date',
                [
                    'label' => 'Date of birth',
                    'years' => range(date('Y'), date('Y') - 120)
                ]
            )
            ->add('indication', 'textarea', ['label' => 'Indication', 'attr' => ['rows' => 5, 'cols' => 20]])
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'register_walk_in';
    }
}
