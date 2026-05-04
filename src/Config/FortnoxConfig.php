<?php

namespace Kurusa\Fortnox\Config;

final readonly class FortnoxConfig
{
    public function __construct(
        public string $clientId,
        public string $clientSecret,
        public string $redirectUri,
        public string $apiBaseUrl = 'https://api.fortnox.se/3',
        public string $authBaseUrl = 'https://apps.fortnox.se/oauth-v1',
    )
    {
    }

    public function authorizationEndpoint(): string
    {
        return sprintf('%s/auth', rtrim($this->authBaseUrl, '/'));
    }

    public function tokenEndpoint(): string
    {
        return sprintf('%s/token', rtrim($this->authBaseUrl, '/'));
    }

    public function apiUrl(string $path): string
    {
        return sprintf(
            '%s/%s',
            rtrim($this->apiBaseUrl, '/'),
            ltrim($path, '/'),
        );
    }

    public function basicAuthorizationHeader(): string
    {
        return sprintf(
            'Basic %s',
            base64_encode(sprintf('%s:%s', $this->clientId, $this->clientSecret)),
        );
    }
}
