<?php

namespace Kurusa\Fortnox\Responses\Accounts;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;
use Kurusa\Fortnox\Responses\MetaInformation;

final readonly class AccountsResponse
{
    use HasSuccessfulStatus;

    /**
     * @param Account[] $accounts
     */
    public function __construct(
        public array $accounts,
        public MetaInformation $metaInformation,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            accounts: array_map(
                function (array $account): Account {
                    return Account::fromArray($account);
                },
                $data['Accounts'] ?? [],
            ),
            metaInformation: MetaInformation::fromArray($data['MetaInformation'] ?? []),
            statusCode: $statusCode,
        );
    }
}
