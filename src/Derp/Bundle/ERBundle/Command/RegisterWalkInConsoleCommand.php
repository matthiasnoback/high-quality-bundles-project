<?php

namespace Derp\Bundle\ERBundle\Command;

use Derp\Bundle\ERBundle\Entity\Sex;
use Derp\Command\RegisterWalkIn;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class RegisterWalkInConsoleCommand extends ContainerAwareCommand
{
    private $command;

    protected function configure()
    {
        $this->setName('register:walk-in');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        /** @var QuestionHelper $questionHelper */
        $questionHelper = $this->getHelper('question');

        // N.B. don't do this, use $input->setOption(...) instead

        $this->command = new RegisterWalkIn();
        $this->command->firstName = $questionHelper->ask(
            $input,
            $output,
            new Question('First name: ')
        );
        $this->command->lastName = $questionHelper->ask(
            $input,
            $output,
            new Question('Last name: ')
        );
        $this->command->indication = 'The indication';
        $this->command->dateOfBirth = \DateTime::createFromFormat('Y-m-d', '1984-04-27');
        $this->command->sex = Sex::MALE;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()->get('command_bus')->handle($this->command);
    }
}
