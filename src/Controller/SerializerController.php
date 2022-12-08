<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SerializerController extends AbstractController
{
    #[Route('/s', name: 'app_serializer')]
    public function index(): Response
    {

        return $this->render('serializer/index.html.twig', [
            'controller_name' => 'SerializerController',
        ]);
    }
}
