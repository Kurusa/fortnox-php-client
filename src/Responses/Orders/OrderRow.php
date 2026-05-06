<?php

namespace Kurusa\Fortnox\Responses\Orders;

final readonly class OrderRow
{
    public function __construct(
        public ?string $accountNumber,
        public ?string $articleNumber,
        public ?float $contributionPercent,
        public ?float $contributionValue,
        public ?string $costCenter,
        public ?string $deliveredQuantity,
        public ?string $description,
        public ?float $discount,
        public ?string $discountType,
        public ?bool $houseWork,
        public ?float $houseWorkHoursToReport,
        public ?string $houseWorkType,
        public ?string $orderedQuantity,
        public ?float $price,
        public ?string $project,
        public ?string $reservedQuantity,
        public ?string $stockPointCode,
        public ?string $stockPointId,
        public ?float $total,
        public ?string $unit,
        public ?int $vat,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            accountNumber: $data['AccountNumber'] ?? null,
            articleNumber: $data['ArticleNumber'] ?? null,
            contributionPercent: isset($data['ContributionPercent']) ? (float)$data['ContributionPercent'] : null,
            contributionValue: isset($data['ContributionValue']) ? (float)$data['ContributionValue'] : null,
            costCenter: $data['CostCenter'] ?? null,
            deliveredQuantity: $data['DeliveredQuantity'] ?? null,
            description: $data['Description'] ?? null,
            discount: isset($data['Discount']) ? (float)$data['Discount'] : null,
            discountType: $data['DiscountType'] ?? null,
            houseWork: isset($data['HouseWork']) ? (bool)$data['HouseWork'] : null,
            houseWorkHoursToReport: isset($data['HouseWorkHoursToReport']) ? (float)$data['HouseWorkHoursToReport'] : null,
            houseWorkType: $data['HouseWorkType'] ?? null,
            orderedQuantity: $data['OrderedQuantity'] ?? null,
            price: isset($data['Price']) ? (float)$data['Price'] : null,
            project: $data['Project'] ?? null,
            reservedQuantity: $data['ReservedQuantity'] ?? null,
            stockPointCode: $data['StockPointCode'] ?? null,
            stockPointId: $data['StockPointId'] ?? null,
            total: isset($data['Total']) ? (float)$data['Total'] : null,
            unit: $data['Unit'] ?? null,
            vat: isset($data['VAT']) ? (int)$data['VAT'] : null,
        );
    }
}
