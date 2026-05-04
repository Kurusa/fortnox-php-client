<?php

namespace Kurusa\Fortnox\Auth;

use Kurusa\Fortnox\Config\FortnoxConfig;
use Kurusa\Fortnox\Enums\AccessType;
use Kurusa\Fortnox\Enums\Scope;
use Kurusa\Fortnox\Http\FortnoxAuthHttpClient;
use Kurusa\Fortnox\ValueObjects\AuthorizationUrl;
use Kurusa\Fortnox\ValueObjects\OAuthToken;

final readonly class OAuthClient
{
    public function __construct(
        private FortnoxConfig $config,
        private FortnoxAuthHttpClient $client,
    ) {
    }

    /**
     * @param list<Scope> $scopes
     */
    public function authorizationUrl(
        array $scopes,
        string $state,
        AccessType $accessType = AccessType::Offline,
        ?string $accountType = null,
    ): AuthorizationUrl {
        $query = array_filter([
            'client_id' => $this->config->clientId,
            'redirect_uri' => $this->config->redirectUri,
            'scope' => Scope::format($scopes),
            'state' => $state,
            'access_type' => $accessType->value,
            'response_type' => 'code',
            'account_type' => $accountType,
        ], static fn ($value): bool => $value !== null);

        return new AuthorizationUrl(
            value: sprintf(
                '%s?%s',
                $this->config->authorizationEndpoint(),
                http_build_query($query, '', '&', PHP_QUERY_RFC3986),
            ),
            state: $state,
        );
    }

    public function exchangeCode(string $code): OAuthToken
    {
        return $this->client->token([
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->config->redirectUri,
        ]);
    }

    public function refresh(string $refreshToken): OAuthToken
    {
        return $this->client->token([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ]);
    }
}
