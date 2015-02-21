<?php

namespace Traditional\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Traditional\Bundle\UserBundle\Command\RegisterUser;

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

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterUser::class,
            'empty_data' => function (FormInterface $form) {
                return new RegisterUser(

                    $form->get('email')->getData(),
                    $form->get('password')->getData(),
                    $form->get('country')->getData()
                );
            }
        ]);
    }

    public function getName()
    {
        return 'create_user';
    }
}
