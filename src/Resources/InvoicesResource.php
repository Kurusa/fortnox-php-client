<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Invoices\CreateInvoiceData;
use Kurusa\Fortnox\Responses\Invoices\InvoiceResponse;
use Kurusa\Fortnox\Responses\Invoices\InvoicesResponse;

final readonly class InvoicesResource extends Resource
{
    public function list(array $query = []): InvoicesResponse
    {
        $raw = $this->client->get('invoices', $query);

        return InvoicesResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function getByDocumentNumber(string $documentNumber): InvoiceResponse
    {
        $raw = $this->client->get(sprintf('invoices/%s', $documentNumber));

        return InvoiceResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function create(CreateInvoiceData $data): InvoiceResponse
    {
        $raw = $this->client->post('invoices', $data->toArray());

        return InvoiceResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function bookkeep(string $documentNumber): InvoiceResponse
    {
        $raw = $this->client->put(sprintf('invoices/%s/bookkeep', $documentNumber));

        return InvoiceResponse::fromRawResponse($raw->statusCode, $raw->data);
    }
}
