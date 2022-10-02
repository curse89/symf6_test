<?php

namespace App\Mail;

class GreetingCardManager implements EmailFormatterAwareInterface
{
    private $enabledFormatters;

    public function setEnabledFormatters(array $enabledFormatters): void
    {
        $this->enabledFormatters = $enabledFormatters;
    }

    // ...
}