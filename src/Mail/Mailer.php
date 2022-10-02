<?php

namespace App\Mail;

class Mailer
{
    public function __construct(public string $method)
    {
        $a = 'test';
    }
}