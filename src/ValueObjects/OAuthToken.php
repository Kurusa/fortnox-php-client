<?php

namespace Kurusa\Fortnox\ValueObjects;

final readonly class OAuthToken
{
    public function __construct(
        public string $accessToken,
        public string $refreshToken,
        public int $expiresIn,
        public ?string $scope = null,
    )
    {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            accessToken: $data['access_token'],
            refreshToken: $data['refresh_token'],
            expiresIn: (int)$data['expires_in'],
            scope: $data['scope'] ?? null,
        );
    }

    public function authorizationHeader(): string
    {
        return sprintf('Bearer %s', $this->accessToken);
    }

    public function toArray(): array
    {
        return [
            'access_token' => $this->accessToken,
            'refresh_token' => $this->refreshToken,
            'expires_in' => $this->expiresIn,
            'scope' => $this->scope,
        ];
    }
}
