<?php

namespace Kurusa\Fortnox\Responses\Customers;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;

final readonly class CustomerResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public Customer $customer,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            customer: Customer::fromArray($data['Customer'] ?? []),
            statusCode: $statusCode,
        );
    }
}
