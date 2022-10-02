<?php

namespace App\Mail;

class EmailConfigurator
{
    private $formatterManager;

    public function __construct(EmailFormatterManager $formatterManager)
    {
        $this->formatterManager = $formatterManager;
    }

    public function __invoke(EmailFormatterAwareInterface $emailManager): void
    {
        $emailManager->setEnabledFormatters(
            $this->formatterManager->getEnabledFormatters()
        );
    }

    public function configure(EmailFormatterAwareInterface $emailManager): void
    {
        $emailManager->setEnabledFormatters(
            $this->formatterManager->getEnabledFormatters()
        );
    }

    // ...
}