<?php

namespace Kurusa\Fortnox\Responses\Articles;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;

final readonly class ArticleResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public Article $article,
        public int $statusCode,
    )
    {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            article: Article::fromArray($data['Article'] ?? []),
            statusCode: $statusCode,
        );
    }
}
