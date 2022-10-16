<?php

namespace App\Controller;

use App\Event\CustomEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    public function __construct(public EventDispatcherInterface $dispatcher)
    {
    }

    #[Route('/event', name: 'app_event')]
    public function index(): Response
    {
        $event = new CustomEvent('hello from controller');
        //$this->dispatcher->dispatch($event);
        $this->dispatcher->dispatch($event, CustomEvent::class);
        //$event = 'foo';
        $this->dispatcher->dispatch($event, 'foo');
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }

    #[Route('/event/1', name: 'app_event/1')]
    public function index1(): Response
    {
        $event = new CustomEvent('hello from controller');
        $this->dispatcher->dispatch($event);
        //$this->dispatcher->dispatch($event, CustomEvent::class);
        return $this->render('event/index.html.twig', [
            'controller_name' => 'EventController',
        ]);
    }
}
