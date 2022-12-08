<?php

namespace App\Message;

class DoctrineMessage
{
    public function __construct(public string $string)
    {
    }

    public function getString(): string
    {
        return $this->string;
    }
}