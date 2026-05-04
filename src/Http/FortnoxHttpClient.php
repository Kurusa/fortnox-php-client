<?php

namespace Kurusa\Fortnox\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Kurusa\Fortnox\Config\FortnoxConfig;
use Kurusa\Fortnox\Contracts\TokenStoreInterface;
use Kurusa\Fortnox\Exceptions\FortnoxApiException;
use Kurusa\Fortnox\Exceptions\MissingTokenException;
use Kurusa\Fortnox\ValueObjects\FortnoxResponse;

final readonly class FortnoxHttpClient
{
    public function __construct(
        private FortnoxConfig $config,
        private ClientInterface $httpClient,
        private TokenStoreInterface $tokenStore,
    )
    {
    }

    public function get(string $path, array $query = []): FortnoxResponse
    {
        return $this->request('GET', $path, [
            'query' => $query,
        ]);
    }

    public function post(string $path, array $payload = []): FortnoxResponse
    {
        return $this->request('POST', $path, [
            'json' => $payload,
        ]);
    }

    public function put(string $path, array $payload = []): FortnoxResponse
    {
        return $this->request('PUT', $path, [
            'json' => $payload,
        ]);
    }

    public function delete(string $path): FortnoxResponse
    {
        return $this->request('DELETE', $path);
    }

    private function request(string $method, string $path, array $options = []): FortnoxResponse
    {
        $token = $this->tokenStore->get();

        if (!$token) {
            throw new MissingTokenException('Fortnox token is missing.');
        }

        try {
            $response = $this->httpClient->request(
                $method,
                $this->config->apiUrl($path),
                [
                    ...$options,
                    'headers' => [
                        ...($options['headers'] ?? []),
                        'Authorization' => $token->authorizationHeader(),
                        'Accept' => 'application/json',
                    ],
                ],
            );
        } catch (RequestException $exception) {
            $response = $exception->getResponse();
            $data = $response
                ? json_decode((string)$response->getBody(), true) ?: []
                : [];

            throw new FortnoxApiException(
                message: $exception->getMessage(),
                statusCode: $response?->getStatusCode() ?? 0,
                response: $data,
                previous: $exception,
            );
        }

        return new FortnoxResponse(
            statusCode: $response->getStatusCode(),
            data: json_decode((string)$response->getBody(), true) ?: [],
            headers: $response->getHeaders(),
        );
    }
}
