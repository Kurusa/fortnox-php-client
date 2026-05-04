<?php

namespace Kurusa\Fortnox\Data\Articles;

final readonly class CreateArticleData
{
    public function __construct(
        public string $description,
        public ?string $articleNumber = null,
        public ?string $unit = null,
        public ?float $purchasePrice = null,
        public ?float $salesPrice = null,
        public ?bool $active = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'Article' => array_filter([
                'Description' => $this->description,
                'ArticleNumber' => $this->articleNumber,
                'Unit' => $this->unit,
                'PurchasePrice' => $this->purchasePrice,
                'SalesPrice' => $this->salesPrice,
                'Active' => $this->active,
            ], static fn($value): bool => $value !== null),
        ];
    }
}
