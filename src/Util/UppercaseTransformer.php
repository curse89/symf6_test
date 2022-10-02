<?php

namespace App\Util;

class UppercaseTransformer implements TransformerInterface
{
    public function transform(string $value): string
    {
        return strtoupper($value);
    }
}