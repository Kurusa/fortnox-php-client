<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Responses\Accounts\AccountResponse;
use Kurusa\Fortnox\Responses\Accounts\AccountsResponse;

final readonly class AccountsResource extends Resource
{
    public function list(array $query = []): AccountsResponse
    {
        $raw = $this->client->get('accounts', $query);

        return AccountsResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function getByNumber(int $number): AccountResponse
    {
        $raw = $this->client->get(sprintf('accounts/%d', $number));

        return AccountResponse::fromRawResponse($raw->statusCode, $raw->data);
    }
}
