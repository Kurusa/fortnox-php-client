<?php

namespace Kurusa\Fortnox\Responses\Customers;

final readonly class Customer
{
    public function __construct(
        public string $customerNumber,
        public ?string $name,
        public ?string $organisationNumber,
        public ?string $email,
        public ?string $phone,
        public ?string $address1,
        public ?string $address2,
        public ?string $zipCode,
        public ?string $city,
        public ?string $country,
        public ?string $deliveryName,
        public ?string $deliveryAddress1,
        public ?string $deliveryAddress2,
        public ?string $deliveryZipCode,
        public ?string $deliveryCity,
        public ?string $yourReference,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            customerNumber: (string)($data['CustomerNumber'] ?? ''),
            name: $data['Name'] ?? null,
            organisationNumber: $data['OrganisationNumber'] ?? null,
            email: $data['Email'] ?? null,
            phone: $data['Phone'] ?? null,
            address1: $data['Address1'] ?? null,
            address2: $data['Address2'] ?? null,
            zipCode: $data['ZipCode'] ?? null,
            city: $data['City'] ?? null,
            country: $data['Country'] ?? null,
            deliveryName: $data['DeliveryName'] ?? null,
            deliveryAddress1: $data['DeliveryAddress1'] ?? null,
            deliveryAddress2: $data['DeliveryAddress2'] ?? null,
            deliveryZipCode: $data['DeliveryZipCode'] ?? null,
            deliveryCity: $data['DeliveryCity'] ?? null,
            yourReference: $data['YourReference'] ?? null,
        );
    }
}
