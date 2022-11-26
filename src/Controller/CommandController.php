<?php

namespace App\Controller;

use SensioLabs\AnsiConverter\AnsiToHtmlConverter;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    #[Route('/command', name: 'app_command')]
    public function index(KernelInterface $kernel): Response
    {
        $application = new Application($kernel);
        $application->setAutoExit(false);
        $input = new ArrayInput([
            'command' => 'meta',
            'arg1'    => 'Fabien',
            '--option1'  => true,
        ]);

        $output = new BufferedOutput(
            OutputInterface::VERBOSITY_NORMAL,
            true // true for decorated
        );
        $application->run($input, $output);

        $converter = new AnsiToHtmlConverter();
        $content = $output->fetch();

        return new Response($converter->convert($content));
    }
}
