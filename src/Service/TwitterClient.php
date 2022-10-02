<?php

namespace App\Service;

use App\Util\Rot13Transformer;
use http\Client\Curl\User;

class TwitterClient
{
    private Rot13Transformer $transformer;

    public function __construct(Rot13Transformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function tweet(User $user, string $key, string $status): void
    {
        $transformedStatus = $this->transformer->transform($status);

        // ... connect to Twitter and send the encoded status
    }
}