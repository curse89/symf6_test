<?php

namespace App\EventListener;

use App\Event\CustomEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

//#[AsEventListener]
//#[AsEventListener(event: CustomEvent::class, method: 'onCustomEvent')]
//#[AsEventListener(event: 'foo', priority: 42)]
final class MyListener
{
    /*public function __invoke(CustomEvent $event): void
    {
        $event->string = 'jjest';
    }*/

    public function onCustomEvent(CustomEvent $event): void
    {
        // ...
    }

    public function onFoo(): void
    {
        $a = 'test';
    }
}