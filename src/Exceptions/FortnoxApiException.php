<?php

namespace Kurusa\Fortnox\Exceptions;

use Throwable;

class FortnoxApiException extends FortnoxException
{
    public function __construct(
        string $message,
        public readonly int $statusCode,
        public readonly array $response = [],
        ?Throwable $previous = null,
    )
    {
        parent::__construct($message, $statusCode, $previous);
    }
}
