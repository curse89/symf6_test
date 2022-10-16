<?php

namespace App\Newsletter;

use Symfony\Component\HttpFoundation\RequestStack;

class NewsletterManager
{
    public RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function anyMethod()
    {
        $request = $this->requestStack->getCurrentRequest();
        // ... do something with the request
    }

    // ...
}