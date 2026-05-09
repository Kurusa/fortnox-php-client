<?php

namespace Kurusa\Fortnox\Responses\Accounts;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;

final readonly class AccountResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public Account $account,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            account: Account::fromArray($data['Account'] ?? []),
            statusCode: $statusCode,
        );
    }
}
