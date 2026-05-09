<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Data\Articles\CreateArticleData;
use Kurusa\Fortnox\Data\Articles\UpdateArticleData;
use Kurusa\Fortnox\Responses\Articles\ArticleResponse;
use Kurusa\Fortnox\Responses\Articles\ArticlesResponse;

final readonly class ArticlesResource extends Resource
{
    public function list(array $query = []): ArticlesResponse
    {
        $raw = $this->client->get('articles', $query);

        return ArticlesResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function getByNumber(string $articleNumber): ArticleResponse
    {
        $raw = $this->client->get(sprintf('articles/%s', $articleNumber));

        return ArticleResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function create(CreateArticleData $data): ArticleResponse
    {
        $raw = $this->client->post('articles', $data->toArray());

        return ArticleResponse::fromRawResponse($raw->statusCode, $raw->data);
    }

    public function update(string $articleNumber, UpdateArticleData $data): ArticleResponse
    {
        $raw = $this->client->put(sprintf('articles/%s', $articleNumber), $data->toArray());

        return ArticleResponse::fromRawResponse($raw->statusCode, $raw->data);
    }
}
