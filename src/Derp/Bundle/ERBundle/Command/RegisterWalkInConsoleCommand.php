<?php

namespace Derp\Bundle\ERBundle\Command;

use Derp\Bundle\ERBundle\Form\RegisterWalkInType;
use Derp\Command\RegisterWalkIn;
use Matthias\SymfonyConsoleForm\Console\Helper\FormHelper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterWalkInConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('register:walk-in');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formHelper = $this->getHelper('form');
        /** @var FormHelper $formHelper */
        $command = $formHelper->interactUsingForm(new RegisterWalkInType(),
            $input, $output);

        $this->getContainer()->get('command_bus')->handle($command);
    }
}
