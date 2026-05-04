<?php

namespace Kurusa\Fortnox\Data\Invoices;

final readonly class InvoiceRowData
{
    public function __construct(
        public string $articleNumber,
        public float $deliveredQuantity,
        public ?string $description = null,
        public ?float $price = null,
        public ?float $discount = null,
    )
    {
    }

    public function toArray(): array
    {
        return array_filter([
            'ArticleNumber' => $this->articleNumber,
            'DeliveredQuantity' => $this->deliveredQuantity,
            'Description' => $this->description,
            'Price' => $this->price,
            'Discount' => $this->discount,
        ], static fn($value): bool => $value !== null);
    }
}
