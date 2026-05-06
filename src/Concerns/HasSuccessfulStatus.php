<?php

namespace Kurusa\Fortnox\Concerns;

trait HasSuccessfulStatus
{
    public function successful(): bool
    {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }
}
