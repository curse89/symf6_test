<?php

namespace App\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Command\SignalableCommandInterface;
use Symfony\Component\Console\Completion\CompletionInput;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

#[AsCommand(
    name: 'test',
    description: 'Add a short description for your command',
    aliases: ['test1'],
    hidden: false
)]
class TestCommand extends Command implements SignalableCommandInterface
{
    use LockableTrait;

    protected static $defaultDescription = 'Creates a new user.';

    public function __construct(public EventDispatcherInterface $eventDispatcher, string $name = null)
    {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setHelp('HELP TO YOU!')
            /*->addArgument(
                'names',
                InputArgument::IS_ARRAY,
                'Who do you want to greet (separate multiple names with a space)?',
                null,
                function (CompletionInput $input) {
                    // the value the user already typed, e.g. when typing "app:greet Fa" before
                    // pressing Tab, this will contain "Fa"
                    $currentValue = $input->getCompletionValue();

                    // get the list of username names from somewhere (e.g. the database)
                    // you may use $currentValue to filter down the names
                    $availableUsernames = ['asd1', 'asd2'];

                    // then suggested the usernames as values
                    return $availableUsernames;
                }
            )*/
            ->addArgument('arg1', InputArgument::REQUIRED, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
            ->addOption(
                'colors',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Which colors do you like?',
                ['blue', 'red']
            )
            /*->addArgument(
                'names',
                InputArgument::IS_ARRAY | InputArgument::REQUIRED,
                'Who do you want to greet (separate multiple names with a space)?'
            )*/
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $app = new Application('echo', '1.0.0');
        $app->run();
        if (!$this->lock()) {
            $output->writeln('The command is already running in another process.');

            return Command::SUCCESS;
        }

        $this->eventDispatcher->addListener(ConsoleEvents::ERROR, function (ConsoleErrorEvent $event) {
            $output = $event->getOutput();

            $command = $event->getCommand();

            $output->writeln(sprintf('Oops, exception thrown while running command <info>%s</info>', $command->getName()));

            // gets the current exit code (the exception code)
            $exitCode = $event->getExitCode();

            // changes the exception to another one
            $event->setError(new \LogicException('Caught exception', $exitCode, $event->getError()));
        });

        throw new \Exception('test');

        $io = new SymfonyStyle($input, $output);
        $outputStyle = new OutputFormatterStyle('red', '#ff0', ['bold', 'blink']);
        $output->getFormatter()->setStyle('fire', $outputStyle);
        $output->writeln('<fire>foo</>');
        $output->writeln('<href=https://symfony.com>Symfony Homepage</>');
        $output->getFormatter()->setStyle('fire', $outputStyle);
        $arg1 = $input->getArgument('arg1');
        $output->writeln('<info>foo</info>');

// yellow text
        $output->writeln('<comment>foo</comment>');

// black text on a cyan background
        $output->writeln('<question>foo</question>');

// white text on a red background
        $output->writeln('<error>foo</error>');
        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->writeln('Whoa!');

        $output->writeln($input->getArguments());

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
    public function getSubscribedSignals(): array
    {
        // return here any of the constants defined by PCNTL extension
        return [\SIGINT, \SIGTERM];
    }

    public function handleSignal(int $signal): void
    {
        if (\SIGTERM === $signal) {
            echo 'jopa';
        }

        // ...
    }

}
