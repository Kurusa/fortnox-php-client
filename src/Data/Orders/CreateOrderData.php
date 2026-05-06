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
        public ?string $ourReference = null,
        public ?string $yourOrderNumber = null,
        public ?string $yourReference = null,
        public ?string $deliveryDate = null,
        public ?string $remarks = null,
        public ?float $freight = null,
        public ?string $wayOfDelivery = null,
        public ?string $deliveryName = null,
        public ?string $deliveryAddress1 = null,
        public ?string $deliveryAddress2 = null,
        public ?string $deliveryCity = null,
        public ?string $deliveryZipCode = null,
        public ?string $phone1 = null,
        public ?string $emailAddressTo = null,
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
                'OurReference' => $this->ourReference,
                'YourOrderNumber' => $this->yourOrderNumber,
                'YourReference' => $this->yourReference,
                'DeliveryDate' => $this->deliveryDate,
                'Remarks' => $this->remarks,
                'Freight' => $this->freight,
                'WayOfDelivery' => $this->wayOfDelivery,
                'DeliveryName' => $this->deliveryName,
                'DeliveryAddress1' => $this->deliveryAddress1,
                'DeliveryAddress2' => $this->deliveryAddress2,
                'DeliveryCity' => $this->deliveryCity,
                'DeliveryZipCode' => $this->deliveryZipCode,
                'Phone1' => $this->phone1,
                'EmailInformation' => $this->emailAddressTo ? [
                    'EmailAddressTo' => $this->emailAddressTo,
                ] : null,
                'OrderRows' => array_map(
                    static fn(OrderRowData $row): array => $row->toArray(),
                    $this->rows,
                ),
            ], static fn($value): bool => $value !== null),
        ];
    }
}
