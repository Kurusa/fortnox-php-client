<?php

namespace Kurusa\Fortnox\Responses\Articles;

final readonly class Article
{
    public function __construct(
        public string $articleNumber,
        public ?string $description,
        public ?string $unit,
        public ?float $purchasePrice,
        public ?float $salesPrice,
        public ?bool $active,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            articleNumber: (string)($data['ArticleNumber'] ?? ''),
            description: $data['Description'] ?? null,
            unit: $data['Unit'] ?? null,
            purchasePrice: isset($data['PurchasePrice']) ? (float)$data['PurchasePrice'] : null,
            salesPrice: isset($data['SalesPrice']) ? (float)$data['SalesPrice'] : null,
            active: isset($data['Active']) ? (bool)$data['Active'] : null,
        );
    }
}
