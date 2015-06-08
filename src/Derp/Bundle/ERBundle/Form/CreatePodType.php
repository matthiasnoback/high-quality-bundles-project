<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\Pod;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CreatePodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('numberOfBeds', 'number', ['mapped' => false])
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'create_pod';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pod::class
        ]);
    }
}
