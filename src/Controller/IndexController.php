<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(
        #[Autowire('%kernel.project_dir%')]
        string $projectDir
    ): Response
    {
        return $this->forward('App\Controller\BlogController::index');
        //return $this->file($projectDir . '/.env');
        //$this->addFlash('notice', 'Welcome');
        //return $this->render('base.html.twig');
        /*if ($projectDir) {
            throw $this->createNotFoundException('Not Found');
        }
        return new Response($projectDir);*/
        //return $this->render('base.html.twig');
    }
}