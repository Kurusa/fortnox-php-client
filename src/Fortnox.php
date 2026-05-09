<?php

namespace Kurusa\Fortnox;

use BadMethodCallException;
use GuzzleHttp\Client;
use Kurusa\Fortnox\Auth\OAuthClient;
use Kurusa\Fortnox\Config\FortnoxConfig;
use Kurusa\Fortnox\Config\ResourceRegistry;
use Kurusa\Fortnox\Contracts\TokenStoreInterface;
use Kurusa\Fortnox\Http\FortnoxAuthHttpClient;
use Kurusa\Fortnox\Http\FortnoxHttpClient;
use Kurusa\Fortnox\Resources\AccountsResource;
use Kurusa\Fortnox\Resources\ArticlesResource;
use Kurusa\Fortnox\Resources\CompanyInformationResource;
use Kurusa\Fortnox\Resources\CustomersResource;
use Kurusa\Fortnox\Resources\InvoicesResource;
use Kurusa\Fortnox\Resources\OrdersResource;
use Kurusa\Fortnox\Resources\Resource;

/**
 * @method ArticlesResource articles()
 * @method CompanyInformationResource companyInformation()
 * @method CustomersResource customers()
 * @method InvoicesResource invoices()
 * @method OrdersResource orders()
 * @method AccountsResource accounts()
 */
final class Fortnox
{
    private Client $httpClient;

    private FortnoxHttpClient $apiClient;

    private FortnoxAuthHttpClient $authClient;

    private array $resources = [];

    public function __construct(
        private readonly FortnoxConfig $config,
        private readonly TokenStoreInterface $tokenStore,
        private readonly array $resourceMap = [],
    )
    {
        $this->httpClient = new Client([
            'timeout' => 30,
        ]);

        $this->apiClient = new FortnoxHttpClient(
            config: $this->config,
            httpClient: $this->httpClient,
            tokenStore: $this->tokenStore,
        );

        $this->authClient = new FortnoxAuthHttpClient(
            config: $this->config,
            httpClient: $this->httpClient,
        );
    }

    public function oauth(): OAuthClient
    {
        return new OAuthClient(
            config: $this->config,
            client: $this->authClient,
        );
    }

    public function __call(string $name, array $arguments): Resource
    {
        $resourceClass = $this->resources()[$name] ?? null;

        if (!$resourceClass) {
            throw new BadMethodCallException(sprintf(
                'Fortnox resource [%s] is not registered.',
                $name,
            ));
        }

        return $this->resources[$name] ??= new $resourceClass($this->apiClient);
    }

    private function resources(): array
    {
        return [
            ...ResourceRegistry::default(),
            ...$this->resourceMap,
        ];
    }
}
