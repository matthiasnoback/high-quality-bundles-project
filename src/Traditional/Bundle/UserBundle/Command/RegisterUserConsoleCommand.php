<?php

namespace Traditional\Bundle\UserBundle\Command;

use Matthias\SymfonyConsoleForm\Console\Helper\FormHelper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traditional\Bundle\UserBundle\Form\CreateUserType;

class RegisterUserConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('user:register');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formType = new CreateUserType();
        $formHelper = $this->getHelper('form');
        /** @var FormHelper $formHelper */
        $command = $formHelper->interactUsingForm(
            $formType,
            $input,
            $output,
            [
                'csrf_protection' => false
            ]
        );

        $this->getContainer()->get('command_bus')->handle($command);
    }
}
