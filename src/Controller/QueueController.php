<?php

namespace App\Controller;

use App\Message\DoctrineMessage;
use App\Message\QueueCommandMessage;
use App\Message\SmsNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class QueueController extends AbstractController
{
    #[Route('/q', name: 'app_queue')]
    public function index(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new SmsNotification('Created message'));
        $bus->dispatch(new QueueCommandMessage());

        return $this->render('queue/index.html.twig', [
            'controller_name' => 'QueueController',
        ]);
    }

    #[Route('/q1', name: 'app_queue1')]
    public function index1(MessageBusInterface $bus): Response
    {
        $bus->dispatch(new DoctrineMessage('something'));

        return $this->render('queue/index.html.twig', [
            'controller_name' => 'QueueController',
        ]);
    }
}
