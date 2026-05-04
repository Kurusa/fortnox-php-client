<?php

namespace Kurusa\Fortnox\ValueObjects;

use Kurusa\Fortnox\Enums\HttpMethod;

final readonly class FortnoxRequest
{
    public function __construct(
        public HttpMethod $method,
        public string $path,
        public array $query = [],
        public array $payload = [],
        public array $headers = [],
    )
    {
    }
}
