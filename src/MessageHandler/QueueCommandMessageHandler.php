<?php

namespace App\MessageHandler;

use App\Message\QueueCommandMessage;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler()]
class QueueCommandMessageHandler
{
    public function __construct(private KernelInterface $kernel)
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(QueueCommandMessage $message)
    {
        echo 'start';
        $app = new Application($this->kernel);
        $app->setAutoExit(false);

        $input = new ArrayInput(
            ['command' => $message->getCommandName()]
        );

        $output = new BufferedOutput();
        $app->run($input, $output);
        echo 'end';
        echo $output->fetch();
    }
}