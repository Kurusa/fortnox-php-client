<?php

namespace Kurusa\Fortnox\Tests\Unit;

use Kurusa\Fortnox\Auth\OAuthClient;
use Kurusa\Fortnox\Config\FortnoxConfig;
use Kurusa\Fortnox\Enums\Scope;
use Kurusa\Fortnox\Http\FortnoxAuthHttpClient;
use PHPUnit\Framework\TestCase;

final class OAuthClientTest extends TestCase
{
    public function test_it_builds_authorization_url(): void
    {
        $config = new FortnoxConfig(
            clientId: 'client-id',
            clientSecret: 'client-secret',
            redirectUri: 'https://example.test/callback',
        );

        $client = new OAuthClient(
            config: $config,
            client: $this->createMock(FortnoxAuthHttpClient::class),
        );

        $authorizationUrl = $client->authorizationUrl(
            scopes: [
                Scope::Article,
                Scope::CompanyInformation,
            ],
            state: 'state-value',
        );

        $url = (string) $authorizationUrl;

        $this->assertStringStartsWith('https://apps.fortnox.se/oauth-v1/auth?', $url);
        $this->assertStringContainsString('client_id=client-id', $url);
        $this->assertStringContainsString('state=state-value', $url);
        $this->assertStringContainsString('access_type=offline', $url);
        $this->assertStringContainsString('response_type=code', $url);
    }
}
