<?php

namespace App\Controller;

use App\Email\NotExistEmailService;
use App\Mail\Mailer;
use App\Newsletter\DecoratingMailer;
use App\Newsletter\DMailer;
use App\Newsletter\NewsletterManager as NLetter;
use App\Mail\NewsletterManager;
use App\Newsletter\NewsletterManager as Emanager;
use App\Repository\DoctrinePostRepository;
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

    #[Route('/di/6', name: 'app_di6')]
    public function test6(Emanager $manager): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/7', name: 'app_di7')]
    public function test7(NotExistEmailService $service): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/8', name: 'app_di8')]
    public function test8(DoctrinePostRepository $rep): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/9', name: 'app_di9')]
    public function test9(NLetter $man): Response
    {
        $req = $man->requestStack->getCurrentRequest();
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }

    #[Route('/di/10', name: 'app_di10')]
    public function test10(DecoratingMailer $man): Response
    {
        return $this->render('di/index.html.twig', [
            'controller_name' => 'DiController',
        ]);
    }
}
