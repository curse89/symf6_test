<?php

namespace App\Util;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;

class Rot13Transformer implements TransformerInterface
{
    private $logger;

    #[Required]
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    public function transform(string $value): string
    {
        return str_rot13($value);
    }
}