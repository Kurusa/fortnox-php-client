<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Articles\CreateArticleData;
use Kurusa\Fortnox\Data\Articles\UpdateArticleData;
use Kurusa\Fortnox\ValueObjects\FortnoxResponse;

final readonly class ArticlesResource extends Resource
{
    public function list(array $query = []): FortnoxResponse
    {
        return $this->client->get('articles', $query);
    }

    public function getByNumber(string $articleNumber): FortnoxResponse
    {
        return $this->client->get(sprintf('articles/%s', $articleNumber));
    }

    public function create(CreateArticleData $data): FortnoxResponse
    {
        return $this->client->post('articles', $data->toArray());
    }

    public function update(string $articleNumber, UpdateArticleData $data): FortnoxResponse
    {
        return $this->client->put(sprintf('articles/%s', $articleNumber), $data->toArray());
    }
}
