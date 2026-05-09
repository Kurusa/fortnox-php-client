<?php

namespace Kurusa\Fortnox\Responses\Customers;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;
use Kurusa\Fortnox\Responses\MetaInformation;

final readonly class CustomersResponse
{
    use HasSuccessfulStatus;

    /**
     * @param Customer[] $customers
     */
    public function __construct(
        public array $customers,
        public MetaInformation $metaInformation,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            customers: array_map(
                function (array $customer): Customer {
                    return Customer::fromArray($customer);
                },
                $data['Customers'] ?? [],
            ),
            metaInformation: MetaInformation::fromArray($data['MetaInformation'] ?? []),
            statusCode: $statusCode,
        );
    }
}
