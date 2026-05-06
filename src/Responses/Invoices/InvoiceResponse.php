<?php

namespace Kurusa\Fortnox\Responses\Invoices;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;

final readonly class InvoiceResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public Invoice $invoice,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            invoice: Invoice::fromArray($data['Invoice'] ?? []),
            statusCode: $statusCode,
        );
    }
}
