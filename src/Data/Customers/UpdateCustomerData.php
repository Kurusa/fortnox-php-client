<?php

namespace Kurusa\Fortnox\Data\Customers;

final readonly class UpdateCustomerData
{
    public function __construct(
        public ?string $name = null,
        public ?string $organisationNumber = null,
        public ?string $email = null,
        public ?string $phone = null,
        public ?string $address1 = null,
        public ?string $address2 = null,
        public ?string $zipCode = null,
        public ?string $city = null,
        public ?string $country = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'Customer' => array_filter([
                'Name' => $this->name,
                'OrganisationNumber' => $this->organisationNumber,
                'Email' => $this->email,
                'Phone' => $this->phone,
                'Address1' => $this->address1,
                'Address2' => $this->address2,
                'ZipCode' => $this->zipCode,
                'City' => $this->city,
                'Country' => $this->country,
            ], static fn($value): bool => $value !== null),
        ];
    }
}
