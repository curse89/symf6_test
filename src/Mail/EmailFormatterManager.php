<?php

namespace App\Mail;

class EmailFormatterManager
{
    // ...

    public function getEnabledFormatters(): array
    {
        // code to configure which formatters to use
        $enabledFormatters = ['xsd'];

        // ...

        return $enabledFormatters;
    }
}