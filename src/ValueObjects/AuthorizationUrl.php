<?php

namespace Kurusa\Fortnox\ValueObjects;

final readonly class AuthorizationUrl
{
    public function __construct(
        public string $value,
        public string $state,
    )
    {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
