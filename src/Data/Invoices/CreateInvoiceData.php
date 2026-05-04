<?php

namespace Kurusa\Fortnox\Data\Invoices;

final readonly class CreateInvoiceData
{
    public function __construct(
        public string $customerNumber,
        public array $rows,
        public ?string $invoiceDate = null,
        public ?string $dueDate = null,
        public ?string $externalInvoiceReference1 = null,
        public ?string $externalInvoiceReference2 = null,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'Invoice' => array_filter([
                'CustomerNumber' => $this->customerNumber,
                'InvoiceDate' => $this->invoiceDate,
                'DueDate' => $this->dueDate,
                'ExternalInvoiceReference1' => $this->externalInvoiceReference1,
                'ExternalInvoiceReference2' => $this->externalInvoiceReference2,
                'InvoiceRows' => array_map(
                    static fn(InvoiceRowData $row): array => $row->toArray(),
                    $this->rows,
                ),
            ], static fn($value): bool => $value !== null),
        ];
    }
}
