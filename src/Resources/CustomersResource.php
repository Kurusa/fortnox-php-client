<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Customers\CreateCustomerData;
use Kurusa\Fortnox\Data\Customers\UpdateCustomerData;
use Kurusa\Fortnox\ValueObjects\FortnoxResponse;

final readonly class CustomersResource extends Resource
{
    public function list(array $query = []): FortnoxResponse
    {
        return $this->client->get('customers', $query);
    }

    public function getByNumber(string $customerNumber): FortnoxResponse
    {
        return $this->client->get(sprintf('customers/%s', $customerNumber));
    }

    public function create(CreateCustomerData $data): FortnoxResponse
    {
        return $this->client->post('customers', $data->toArray());
    }

    public function update(string $customerNumber, UpdateCustomerData $data): FortnoxResponse
    {
        return $this->client->put(sprintf('customers/%s', $customerNumber), $data->toArray());
    }

    public function deleteByNumber(string $customerNumber): FortnoxResponse
    {
        return $this->client->delete(sprintf('customers/%s', $customerNumber));
    }
}
