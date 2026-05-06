<?php

namespace Kurusa\Fortnox\Responses\Orders;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;

final readonly class OrderResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public Order $order,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            order: Order::fromArray($data['Order'] ?? []),
            statusCode: $statusCode,
        );
    }
}
