<?php

namespace Derp\Bundle\ERBundle\Command;

use Derp\Application\RegisterWalkIn;
use Derp\Bundle\ERBundle\Entity\PatientId;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class RegisterWalkInCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('register:walk-in');
        $this->addOption('firstName', null, InputOption::VALUE_REQUIRED);
        $this->addOption('lastName', null, InputOption::VALUE_REQUIRED);
        $this->addOption('dateOfBirth', null, InputOption::VALUE_REQUIRED);
        $this->addOption('indication', null, InputOption::VALUE_REQUIRED);
        $this->addOption('sex', null, InputOption::VALUE_REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new RegisterWalkIn();
        $command->id = (string) PatientId::generate();
        $command->firstName = $input->getOption('firstName');
        $command->lastName = $input->getOption('lastName');
        $command->dateOfBirth = $input->getOption('dateOfBirth');
        $command->indication = $input->getOption('indication');
        $command->sex = $input->getOption('sex');

        $this->getContainer()->get('command_bus')->handle($command);
    }
}
