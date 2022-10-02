<?php

namespace App\Util;

interface TransformerInterface
{
    public function transform(string $value): string;
}