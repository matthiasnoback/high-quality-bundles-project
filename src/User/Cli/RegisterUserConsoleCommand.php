<?php

namespace User\Cli;

use Matthias\SymfonyConsoleForm\Console\Helper\FormHelper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Traditional\Bundle\UserBundle\Form\CreateUserType;
use User\Command\RegisterUser;

class RegisterUserConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:register');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formHelper = $this->getHelper('form');
        /** @var FormHelper $formHelper */

        $command = $formHelper->interactUsingForm(new CreateUserType(), $input, $output);

        $this->getContainer()->get('command_bus')->handle($command);
    }
}
