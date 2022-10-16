<?php

namespace App\Event;

class CustomEvent
{
    public function __construct(public string $string)
    {
    }
}