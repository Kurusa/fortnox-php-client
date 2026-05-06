<?php

namespace Kurusa\Fortnox\Responses;

final readonly class MetaInformation
{
    public function __construct(
        public int $totalPages,
        public int $currentPage,
        public int $totalResources,
        public int $pageSize,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            totalPages: (int)($data['@TotalPages'] ?? 1),
            currentPage: (int)($data['@CurrentPage'] ?? 1),
            totalResources: (int)($data['@TotalResources'] ?? 0),
            pageSize: (int)($data['@PageSize'] ?? 0),
        );
    }
}
