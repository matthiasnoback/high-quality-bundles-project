<?php

namespace Traditional\Bundle\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Traditional\Bundle\UserBundle\Command\RegisterUser;
use Traditional\Bundle\UserBundle\Entity\UserRepository;

class CreateUserType extends AbstractType
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

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
            'empty_data' => function() {
                $data = new RegisterUser();
                $data->id = $this->userRepository->nextIdentity();

                return $data;
            }
        ]);
    }

    public function getName()
    {
        return 'create_user';
    }
}
