<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\Sex;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SexType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'sex',
                'choice',
                [
                    'choices' => [Sex::MALE => 'Male', Sex::FEMALE => 'Female', Sex::INTERSEX => 'Intersex']
                ]
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sex::class
        ]);
    }

    public function getName()
    {
        return 'sex';
    }
}
