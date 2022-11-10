<?php

namespace App\Session;

class TtlHandler
{
    public function __invoke(): int
    {
        return 1000;
    }
}