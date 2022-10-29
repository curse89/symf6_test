<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Entity\Customer;
use App\Entity\Invoice;
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BasicController extends AbstractController
{
    public function __construct(public EntityManagerInterface $em)
    {
    }

    #[Route('/en', name: 'en', methods: ['GET'])]
    public function start(): JsonResponse
    {
        $post = new BlogPost();
        $post->setSlug('xxx');
        $post->setText('text');
        $this->em->persist($post);
        $this->em->flush();
        return new JsonResponse('privet1');
    }

    #[Route('/en1', name: 'en1', methods: ['GET'])]
    public function start1(): JsonResponse
    {
        $ent = $this->em->getRepository(BlogPost::class)->findOneBy(['id' => 2]);
        $this->em->persist($ent);
        return new JsonResponse('privet1');
    }

    #[Route('/en2', name: 'en2', methods: ['GET'])]
    public function start2(Connection $connection): JsonResponse
    {
        $posts = $connection->fetchAllAssociative('SELECT * FROM blog_post');
        return new JsonResponse('privet1');
    }

    #[Route('/en3', name: 'en3', methods: ['GET'])]
    public function start3(): JsonResponse
    {
        $cust = new Customer();
        $cust->setName('Vladimir');
        $invoice = new Invoice();
        $invoice->setSubject($cust);
        $this->em->persist($cust);
        $this->em->persist($invoice);
        $this->em->flush();
        return new JsonResponse('privet1');
    }

    #[Route('/en4', name: 'en4', methods: ['GET'])]
    public function start4(): JsonResponse
    {
        $ent = $this->em->getRepository(Invoice::class)->findOneBy(['id' => 1]);
        $x = $ent->getSubject();
        $name = $x->getName();
        return new JsonResponse('privet1');
    }
}