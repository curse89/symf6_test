<?php

namespace App\Newsletter;

class DecoratingMailer
{
    public string $text = 'decorated';
    public function __construct(public DMailer $mailer)
    {
    }
}