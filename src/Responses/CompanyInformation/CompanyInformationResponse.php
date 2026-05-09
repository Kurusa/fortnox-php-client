<?php

namespace Kurusa\Fortnox\Responses\CompanyInformation;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;

final readonly class CompanyInformationResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public CompanyInformation $companyInformation,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            companyInformation: CompanyInformation::fromArray($data['CompanyInformation'] ?? []),
            statusCode: $statusCode,
        );
    }
}
