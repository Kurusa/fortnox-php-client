<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Http\FortnoxHttpClient;

abstract readonly class Resource
{
    public function __construct(
        protected FortnoxHttpClient $client,
    )
    {
    }
}
