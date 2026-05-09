<?php

namespace Kurusa\Fortnox\Responses\Invoices;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;
use Kurusa\Fortnox\Responses\MetaInformation;

final readonly class InvoicesResponse
{
    use HasSuccessfulStatus;

    /**
     * @param Invoice[] $invoices
     */
    public function __construct(
        public array $invoices,
        public MetaInformation $metaInformation,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            invoices: array_map(
                function (array $invoice): Invoice {
                    return Invoice::fromArray($invoice);
                },
                $data['Invoices'] ?? [],
            ),
            metaInformation: MetaInformation::fromArray($data['MetaInformation'] ?? []),
            statusCode: $statusCode,
        );
    }
}
