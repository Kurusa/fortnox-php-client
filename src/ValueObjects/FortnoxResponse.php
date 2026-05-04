<?php

namespace Kurusa\Fortnox\ValueObjects;

final readonly class FortnoxResponse
{
    public function __construct(
        public int $statusCode,
        public array $data,
        public array $headers = [],
    )
    {
    }

    public function successful(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }
}
