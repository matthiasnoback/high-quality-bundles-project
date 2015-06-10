<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\Patient;
use Derp\Bundle\ERBundle\Entity\Sex;
use Derp\Command\RegisterWalkIn;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
                'birthDate',
                'date',
                [
                    'label' => 'Date of birth',
                    'years' => range(date('Y'), date('Y') - 120)
                ]
            )
            ->add('indication', 'textarea', ['label' => 'Indication', 'attr' => ['rows' => 5, 'cols' => 20]])
            ->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterWalkIn::class
        ]);
    }

    public function getName()
    {
        return 'register_walk_in';
    }
}
