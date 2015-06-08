<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\FullName;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FullNameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text')
            ->add('lastName', 'text');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FullName::class
        ]);
    }

    public function getName()
    {
        return 'full_name';
    }
}
