<?php

namespace Kurusa\Fortnox\Responses\Accounts;

final readonly class Account
{
    public function __construct(
        public ?int $number,
        public ?string $description,
        public ?string $vatCode,
        public ?bool $active,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            number: isset($data['Number']) ? (int)$data['Number'] : null,
            description: $data['Description'] ?? null,
            vatCode: $data['VATCode'] ?? null,
            active: $data['Active'] ?? null,
        );
    }
}
