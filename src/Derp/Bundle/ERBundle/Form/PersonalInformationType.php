<?php

namespace Derp\Bundle\ERBundle\Form;

use Derp\Bundle\ERBundle\Entity\PersonalInformation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonalInformationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullName', new FullNameType(), ['property_path' => 'name'])
            ->add('birthDate', new BirthDateType(), ['property_path' => 'dateOfBirth'])
            ->add('sex', new SexType());
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PersonalInformation::class
        ]);
    }

    public function getName()
    {
        return 'personal_information';
    }
}
