<?php

namespace Kurusa\Fortnox\Http;

use GuzzleHttp\Client;
use Kurusa\Fortnox\Config\FortnoxConfig;
use Kurusa\Fortnox\ValueObjects\OAuthToken;

readonly class FortnoxAuthHttpClient
{
    public function __construct(
        private FortnoxConfig $config,
        private Client $httpClient,
    )
    {
    }

    public function token(array $formParams): OAuthToken
    {
        $response = $this->httpClient->request('POST', $this->config->tokenEndpoint(), [
            'headers' => [
                'Authorization' => $this->config->basicAuthorizationHeader(),
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json',
            ],
            'form_params' => $formParams,
        ]);

        return OAuthToken::fromArray(
            json_decode((string)$response->getBody(), true, flags: JSON_THROW_ON_ERROR),
        );
    }
}
