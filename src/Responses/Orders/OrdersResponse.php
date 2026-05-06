<?php

namespace Kurusa\Fortnox\Responses\Orders;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;
use Kurusa\Fortnox\Responses\MetaInformation;

final readonly class OrdersResponse
{
    use HasSuccessfulStatus;

    /**
     * @param Order[] $orders
     */
    public function __construct(
        public array $orders,
        public MetaInformation $metaInformation,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            orders: array_map(
                static fn(array $order): Order => Order::fromArray($order),
                $data['Orders'] ?? [],
            ),
            metaInformation: MetaInformation::fromArray($data['MetaInformation'] ?? []),
            statusCode: $statusCode,
        );
    }
}
