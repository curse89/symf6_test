<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'queue',
    description: 'Add a short description for your command',
)]
class QueueCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        echo 'hello from command';

        return Command::SUCCESS;
    }
}