<?php

namespace Kurusa\Fortnox\Responses\Articles;

use Kurusa\Fortnox\Concerns\HasSuccessfulStatus;
use Kurusa\Fortnox\Responses\MetaInformation;

final readonly class ArticlesResponse
{
    use HasSuccessfulStatus;

    public function __construct(
        public array $articles,
        public MetaInformation $metaInformation,
        public int $statusCode,
    ) {
    }

    public static function fromRawResponse(int $statusCode, array $data): self
    {
        return new self(
            articles: array_map(
                function (array $article): Article {
                    return Article::fromArray($article);
                },
                $data['Articles'] ?? [],
            ),
            metaInformation: MetaInformation::fromArray($data['MetaInformation'] ?? []),
            statusCode: $statusCode,
        );
    }
}
