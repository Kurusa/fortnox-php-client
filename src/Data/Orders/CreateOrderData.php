<?php

namespace Kurusa\Fortnox\Data\Orders;

final readonly class CreateOrderData
{
    public function __construct(
        public string $customerNumber,
        public array $rows,
        public ?string $orderDate = null,
        public ?string $externalInvoiceReference1 = null,
        public ?string $externalInvoiceReference2 = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'Order' => array_filter([
                'CustomerNumber' => $this->customerNumber,
                'OrderDate' => $this->orderDate,
                'ExternalInvoiceReference1' => $this->externalInvoiceReference1,
                'ExternalInvoiceReference2' => $this->externalInvoiceReference2,
                'OrderRows' => array_map(
                    static fn(OrderRowData $row): array => $row->toArray(),
                    $this->rows,
                ),
            ], static fn($value): bool => $value !== null),
        ];
    }
}
