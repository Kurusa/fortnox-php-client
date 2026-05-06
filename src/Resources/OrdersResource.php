<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Orders\CreateOrderData;
use Kurusa\Fortnox\Responses\Orders\OrderResponse;
use Kurusa\Fortnox\Responses\Orders\OrdersResponse;

final readonly class OrdersResource extends Resource
{
    public function list(array $query = []): OrdersResponse
    {
        $raw = $this->client->get('orders', $query);

        return OrdersResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function getByDocumentNumber(string $documentNumber): OrderResponse
    {
        $raw = $this->client->get(sprintf('orders/%s', $documentNumber));

        return OrderResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function create(CreateOrderData $data): OrderResponse
    {
        $raw = $this->client->post('orders', $data->toArray());

        return OrderResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function update(string $documentNumber, array $payload): OrderResponse
    {
        $raw = $this->client->put(sprintf('orders/%s', $documentNumber), $payload);

        return OrderResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function createInvoice(string $documentNumber): OrderResponse
    {
        $raw = $this->client->put(sprintf('orders/%s/createinvoice', $documentNumber));

        return OrderResponse::fromRawResponse($raw->statusCode, $raw->data);
    }
}
