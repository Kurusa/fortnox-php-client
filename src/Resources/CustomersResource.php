<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Customers\CreateCustomerData;
use Kurusa\Fortnox\Data\Customers\UpdateCustomerData;
use Kurusa\Fortnox\Responses\Customers\CustomerResponse;

final readonly class CustomersResource extends Resource
{
    public function list(array $query = []): array
    {
        return $this->client->get('customers', $query)->data;
    }

    public function getByNumber(string $customerNumber): CustomerResponse
    {
        $raw = $this->client->get(sprintf('customers/%s', $customerNumber));

        return CustomerResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function create(CreateCustomerData $data): CustomerResponse
    {
        $raw = $this->client->post('customers', $data->toArray());

        return CustomerResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function update(string $customerNumber, UpdateCustomerData $data): CustomerResponse
    {
        $raw = $this->client->put(sprintf('customers/%s', $customerNumber), $data->toArray());

        return CustomerResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function deleteByNumber(string $customerNumber): bool
    {
        return $this->client->delete(sprintf('customers/%s', $customerNumber))->successful();
    }
}
