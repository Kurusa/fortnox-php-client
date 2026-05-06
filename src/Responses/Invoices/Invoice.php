<?php

namespace Kurusa\Fortnox\Responses\Invoices;

final readonly class Invoice
{
    public function __construct(
        public string $documentNumber,
        public ?string $customerNumber,
        public ?string $customerName,
        public ?string $invoiceDate,
        public ?string $dueDate,
        public ?float $total,
        public ?float $totalVat,
        public ?bool $booked,
        public ?bool $cancelled,
        public ?string $currency,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            documentNumber: (string)($data['DocumentNumber'] ?? ''),
            customerNumber: $data['CustomerNumber'] ?? null,
            customerName: $data['CustomerName'] ?? null,
            invoiceDate: $data['InvoiceDate'] ?? null,
            dueDate: $data['DueDate'] ?? null,
            total: isset($data['Total']) ? (float)$data['Total'] : null,
            totalVat: isset($data['TotalVAT']) ? (float)$data['TotalVAT'] : null,
            booked: isset($data['Booked']) ? (bool)$data['Booked'] : null,
            cancelled: isset($data['Cancelled']) ? (bool)$data['Cancelled'] : null,
            currency: $data['Currency'] ?? null,
        );
    }
}
