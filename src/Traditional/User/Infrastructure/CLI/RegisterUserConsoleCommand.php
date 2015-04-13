<?php

namespace Traditional\User\Infrastructure\CLI;

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

        $command = $formHelper->interactUsingForm($formType, $input, $output);

        $output->writeln('<comment>Handling command</comment>');
        $this->getContainer()->get('command_bus')->handle($command);
        $output->writeln('<info>Done</info>');
    }
}
