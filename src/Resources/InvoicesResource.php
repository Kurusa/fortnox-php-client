<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Invoices\CreateInvoiceData;
use Kurusa\Fortnox\ValueObjects\FortnoxResponse;

final readonly class InvoicesResource extends Resource
{

    public function list(array $query = []): FortnoxResponse
    {
        return $this->client->get('invoices', $query);
    }

    public function getByDocumentNumber(string $documentNumber): FortnoxResponse
    {
        return $this->client->get(sprintf('invoices/%s', $documentNumber));
    }

    public function create(CreateInvoiceData $data): FortnoxResponse
    {
        return $this->client->post('invoices', $data->toArray());
    }

    public function bookkeep(string $documentNumber): FortnoxResponse
    {
        return $this->client->put(sprintf('invoices/%s/bookkeep', $documentNumber));
    }
}
