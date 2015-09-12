<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\BirthDate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BirthDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'date',
                'date',
                [
                    'label' => 'Date of birth (if you don\'t know, guess)',
                    'years' => range(date('Y'), date('Y') - 120),
                    // Use this option to make the underlying format a string (instead of a DateTime object)
                    //'input' => 'string'
                ]
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BirthDate::class
        ]);
    }

    public function getName()
    {
        return 'birth_date';
    }
}
