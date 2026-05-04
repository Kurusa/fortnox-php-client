<?php

namespace Kurusa\Fortnox\Contracts;

use Kurusa\Fortnox\ValueObjects\OAuthToken;

interface TokenStoreInterface
{
    public function get(): ?OAuthToken;

    public function save(OAuthToken $token): void;
}
