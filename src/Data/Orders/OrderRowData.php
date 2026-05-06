<?php

namespace Kurusa\Fortnox\Data\Orders;

final readonly class OrderRowData
{
    public function __construct(
        public string $articleNumber,
        public float $deliveredQuantity,
        public ?string $description = null,
        public ?float $price = null,
        public ?float $discount = null,
        public ?float $orderedQuantity = null,
        public ?string $unit = null,
        public ?string $accountNumber = null,
    )
    {
    }

    public static function text(string $description): self
    {
        return new self(
            articleNumber: '',
            deliveredQuantity: 0,
            description: $description,
            price: 0,
            orderedQuantity: 0,
            unit: '',
            accountNumber: '0',
        );
    }

    public static function article(
        string $articleNumber,
        string $description,
        float $price,
        string $accountNumber,
    ): self
    {
        return new self(
            articleNumber: $articleNumber,
            deliveredQuantity: 1,
            description: $description,
            price: $price,
            orderedQuantity: 1,
            unit: '',
            accountNumber: $accountNumber,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'ArticleNumber' => $this->articleNumber,
            'DeliveredQuantity' => $this->deliveredQuantity,
            'Description' => $this->description,
            'Price' => $this->price,
            'Discount' => $this->discount,
            'OrderedQuantity' => $this->orderedQuantity,
            'Unit' => $this->unit,
            'AccountNumber' => $this->accountNumber,
        ], static fn($value): bool => $value !== null);
    }
}
