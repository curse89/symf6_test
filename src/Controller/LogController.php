<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogController extends AbstractController
{
    #[Route('/log', name: 'app_log')]
    public function index(LoggerInterface $chickenLogger, Request $request): Response
    {
        $session = $request->getSession();
        //$session->has('asd');
        $chickenLogger->info('PRIVET');
        $chickenLogger->error('ERROR');
        syslog(LOG_WARNING, "WARNING ACCESS TO UNAUTHORIZED USER!!!!");

        return $this->render('log/index.html.twig', [
            'controller_name' => 'LogController',
        ]);
    }

    #[Route('/log1', name: 'app_log1')]
    public function index1(LoggerInterface $chickenLogger, Request $request): Response
    {
        $session = $request->getSession();
        $session->set('asd', 'privet');
        $chickenLogger->info('PRIVET');
        $chickenLogger->error('ERROR');
        syslog(LOG_WARNING, "WARNING ACCESS TO UNAUTHORIZED USER!!!!");

        return $this->render('log/index.html.twig', [
            'controller_name' => 'LogController',
        ]);
    }
}
