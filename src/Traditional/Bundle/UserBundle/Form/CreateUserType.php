<?php

namespace Traditional\Bundle\UserBundle\Form;

use Rhumsaa\Uuid\Uuid;
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
            ->add('email', 'email', ['label' => 'What is your email address?'])
            ->add('password', 'password', ['label' => 'Which password would you like?'])
            ->add('country', 'country', ['label' => 'In which country do you live?']);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Traditional\Bundle\UserBundle\Command\RegisterUser',
                'empty_data' => function (FormInterface $form) {
                    return new RegisterUser(
                        (string) Uuid::uuid4(),
                        $form->get('email')->getData(),
                        $form->get('password')->getData(),
                        $form->get('country')->getData()
                    );
                }
            ]
        );
    }

    public function getName()
    {
        return 'create_user';
    }
}
