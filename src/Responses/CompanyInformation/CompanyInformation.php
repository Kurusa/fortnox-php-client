<?php

namespace Kurusa\Fortnox\Responses\CompanyInformation;

final readonly class CompanyInformation
{
    public function __construct(
        public ?string $companyName,
        public ?string $organizationNumber,
        public ?string $address,
        public ?string $zipCode,
        public ?string $city,
        public ?string $phone,
        public ?string $email,
        public ?string $website,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            companyName: $data['CompanyName'] ?? null,
            organizationNumber: $data['OrganizationNumber'] ?? null,
            address: $data['Address'] ?? null,
            zipCode: $data['ZipCode'] ?? null,
            city: $data['City'] ?? null,
            phone: $data['Phone'] ?? null,
            email: $data['Email'] ?? null,
            website: $data['Website'] ?? null,
        );
    }
}
