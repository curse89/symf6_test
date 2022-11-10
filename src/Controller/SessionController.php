<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route('/s', name: 'app_session')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        $session->set('key', 'value');

        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }

    #[Route('/s1', name: 'app_session1')]
    public function get(Request $request): Response
    {
        $session = $request->getSession();
        $session->get('key');

        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }
}
