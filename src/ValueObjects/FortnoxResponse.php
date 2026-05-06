<?php

namespace Kurusa\Fortnox\ValueObjects;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;

final readonly class FortnoxResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public int $statusCode,
        public array $data,
        public array $headers = [],
    )
    {
    }
}
