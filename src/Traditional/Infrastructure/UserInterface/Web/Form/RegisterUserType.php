<?php

namespace Traditional\Infrastructure\UserInterface\Web\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Traditional\Core\User\Register\RegisterUser;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email')
            ->add('password', 'password')
            ->add('country', 'country')
            ->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'empty_data' => function (FormInterface $form) {
                    return new RegisterUser(
                        $form->get('email')->getData(),
                        $form->get('password')->getData(),
                        $form->get('country')->getData()
                    );
                },
                'data_class' => RegisterUser::class
            )
        );
    }

    public function getName()
    {
        return 'register_user';
    }
}
