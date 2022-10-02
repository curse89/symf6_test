<?php

namespace App\Controller;

use App\Mail\Mailer;
use App\Mail\NewsletterManager;
use App\Util\Rot13Transformer;
use App\Util\TransformerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiController extends AbstractController
{
    #[Route('/di', name: 'app_di')]
    public function index(Rot13Transformer $transformer): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/1', name: 'app_di1')]
    public function test1(TransformerInterface $transformer): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/2', name: 'app_di2')]
    public function test2(TransformerInterface $shoutyTransformer): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/3', name: 'app_di3')]
    public function test3(
        #[Autowire(service: 'transformer')] Rot13Transformer $transformer,
        #[Autowire('%kernel.project_dir%')] string $dir
    ): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/4', name: 'app_di4')]
    public function test4(NewsletterManager $manager): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/5', name: 'app_di5')]
    public function test5(Mailer $mailer): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }
}
