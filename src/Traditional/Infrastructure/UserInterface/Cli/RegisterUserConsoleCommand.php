<?php

namespace Traditional\Infrastructure\UserInterface\Cli;

use SimpleBus\Command\Bus\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Traditional\Core\User\Register\RegisterUser;

class RegisterUserConsoleCommand extends Command
{
    private $validator;
    private $commandBus;

    public function __construct(ValidatorInterface $validator, CommandBus $commandBus)
    {
        $this->validator = $validator;
        $this->commandBus = $commandBus;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('user:register')
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
            ->addArgument('country', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = new RegisterUser(
            $input->getArgument('email'),
            $input->getArgument('password'),
            $input->getArgument('country')
        );

        $constraintViolationList = $this->validator->validate($command);
        if (count($constraintViolationList) === 0) {
            $this->commandBus->handle($command);

            $output->writeln('<info>Done</info>');
        } else {
            $output->writeln('<error>Invalid input</error>');
            $output->write((string) $constraintViolationList);
        }
    }
}
