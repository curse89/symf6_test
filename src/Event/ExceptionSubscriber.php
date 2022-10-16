<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // return the subscribed events, their methods and priorities
        return [
            CustomEvent::class => [
                ['processException', 10],
                ['logException', 0],
                ['notifyException', -10],
            ],
        ];
    }

    public function processException(CustomEvent $event)
    {
        $a = 1;
    }

    public function logException(CustomEvent $event)
    {
        $a = 1;
    }

    public function notifyException(CustomEvent $event)
    {
        $a = 1;
    }
}