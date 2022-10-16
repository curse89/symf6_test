<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrivController extends AbstractController
{
    #[Route('/priv', name: 'app_priv')]
    public function index(): Response
    {
        return $this->render('priv/index.html.twig', [
            'controller_name' => 'PrivController',
        ]);
    }
}
