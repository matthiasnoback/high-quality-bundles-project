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
        $builder->add('date', 'datetime');
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
