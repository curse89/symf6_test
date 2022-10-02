<?php

namespace App\Mail;

class MailerConfiguration
{
    public function getMailerMethod(): string
    {
        return 'sendmail';
    }
}