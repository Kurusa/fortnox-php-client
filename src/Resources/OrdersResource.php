<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Orders\CreateOrderData;
use Kurusa\Fortnox\ValueObjects\FortnoxResponse;

final readonly class OrdersResource extends Resource
{
    public function list(array $query = []): FortnoxResponse
    {
        return $this->client->get('orders', $query);
    }

    public function getByDocumentNumber(string $documentNumber): FortnoxResponse
    {
        return $this->client->get(sprintf('orders/%s', $documentNumber));
    }

    public function create(CreateOrderData $data): FortnoxResponse
    {
        return $this->client->post('orders', $data->toArray());
    }
}
