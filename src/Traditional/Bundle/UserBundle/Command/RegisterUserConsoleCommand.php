<?php

namespace Traditional\Bundle\UserBundle\Command;

use Matthias\SymfonyConsoleForm\Console\Helper\FormHelper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Intl\Intl;
use Traditional\Bundle\UserBundle\Form\CreateUserType;

class RegisterUserConsoleCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:register')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $formHelper = $this->getHelper('form');
        /** @var $formHelper FormHelper */

        $command = $formHelper->interactUsingForm(new CreateUserType(), $input, $output, ['csrf_protection' => false]);

        $this->getContainer()->get('command_bus')->handle($command);
    }
}
