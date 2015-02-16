<?php

namespace Traditional\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', ['label' => 'Your email address'])
            ->add('password', 'password', ['label' => 'Your password'])
            ->add('country', 'country', ['label' => 'Your country'])
            ->add('submit', 'submit');
    }

    public function getName()
    {
        return 'create_user';
    }
}
