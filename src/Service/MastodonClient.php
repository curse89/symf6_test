<?php

namespace App\Service;

use App\Util\TransformerInterface;
use http\Client\Curl\User;

class MastodonClient
{
    private $transformer;

    public function __construct(TransformerInterface $shoutyTransformer)
    {
        $this->transformer = $shoutyTransformer;
    }

    public function toot(User $user, string $key, string $status): void
    {
        $transformedStatus = $this->transformer->transform($status);

        // ... connect to Mastodon and send the transformed status
    }
}