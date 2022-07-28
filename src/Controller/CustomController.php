<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CustomController extends AbstractController
{
    public function custom($parameter): Response
    {
        return new Response($parameter);
    }

    public function test(): Response
    {
        return new Response('test');
    }
}
