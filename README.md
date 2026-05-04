# Fortnox PHP Client

PHP client for the Fortnox API with OAuth2 support.

## Installation

```bash
composer require kurusa/fortnox-php-client
```

## Token store

The client does not decide where OAuth tokens are stored. Implement `TokenStoreInterface` in your application.

```php
use Kurusa\Fortnox\Contracts\TokenStoreInterface;
use Kurusa\Fortnox\ValueObjects\OAuthToken;

final class ArrayTokenStore implements TokenStoreInterface
{
    private ?OAuthToken $token = null;

    public function get(): OAuthToken
    {
        return $this->token;
    }

    public function save(OAuthToken $token): void
    {
        $this->token = $token;
    }
}
```

## Basic setup

```php
use Kurusa\Fortnox\Config\FortnoxConfig;
use Kurusa\Fortnox\Fortnox;

$tokenStore = new ArrayTokenStore();

$config = new FortnoxConfig(
    clientId: config('fortnox.client_id'),
    clientSecret: config('fortnox.client_secret'),
    redirectUri: config('fortnox.redirect_uri'),
);

$fortnox = new Fortnox(
    config: $config,
    tokenStore: $tokenStore,
);
```

## OAuth flow

### Authorization URL

```php
use Kurusa\Fortnox\Enums\AccessType;
use Kurusa\Fortnox\Enums\Scope;

$authorizationUrl = $fortnox
    ->oauth()
    ->authorizationUrl(
        scopes: [
            Scope::Article,
            Scope::CompanyInformation,
            Scope::Customer,
            Scope::Invoice,
            Scope::Order,
        ],
        state: bin2hex(random_bytes(16)),
        accessType: AccessType::Offline,
    );
    
echo (string) $authorizationUrl;
```

The user should be redirected to the generated URL. After approval, Fortnox redirects back to your configured redirect URI with a `code` and `state`.

### Exchange authorization code for token

```php
$token = $fortnox
    ->oauth()
    ->exchangeCode($_GET['code']);

$tokenStore->save($token);
```

The returned object is an `OAuthToken`:

```php
$token->accessToken;
$token->refreshToken;
$token->expiresIn;
$token->scope;
```

### Refresh token

```php
$currentToken = $tokenStore->get();

$newToken = $fortnox
    ->oauth()
    ->refresh($currentToken->refreshToken);

$tokenStore->save($newToken);
```

When refreshing a Fortnox token, store the newly returned refresh token. The old refresh token should not be reused.

## API usage

API methods return `FortnoxResponse`.

```php
$response->statusCode;
$response->data;
$response->headers;
$response->successful();
```

Example:

```php
$response = $fortnox->customers()->list();

if ($response->successful()) {
    print_r($response->data);
}
```

## Customers

```php
use Kurusa\Fortnox\Data\Customers\CreateCustomerData;
use Kurusa\Fortnox\Data\Customers\UpdateCustomerData;

$response = $fortnox->customers()->list();

$response = $fortnox->customers()->getByNumber('1');

$response = $fortnox->customers()->create(new CreateCustomerData(
    name: 'Example Customer',
    email: 'customer@example.test',
    phone: '+37200000000',
    address1: 'Example Street 1',
    zipCode: '12345',
    city: 'Tallinn',
    country: 'Estonia',
));

$response = $fortnox->customers()->update('1', new UpdateCustomerData(
    email: 'new-email@example.test',
    phone: '+37211111111',
));

$response = $fortnox->customers()->deleteByNumber('1');
```

## Articles

```php
use Kurusa\Fortnox\Data\Articles\CreateArticleData;
use Kurusa\Fortnox\Data\Articles\UpdateArticleData;

$response = $fortnox->articles()->list();

$response = $fortnox->articles()->getByNumber('SKU-001');

$response = $fortnox->articles()->create(new CreateArticleData(
    description: 'Example article',
    articleNumber: 'SKU-001',
    unit: 'pcs',
    salesPrice: 10.50,
    active: true,
));

$response = $fortnox->articles()->update('SKU-001', new UpdateArticleData(
    description: 'Updated article',
    salesPrice: 12.00,
));
```

## Orders

```php
use Kurusa\Fortnox\Data\Orders\CreateOrderData;
use Kurusa\Fortnox\Data\Orders\OrderRowData;

$response = $fortnox->orders()->list();

$response = $fortnox->orders()->getByDocumentNumber('1001');

$response = $fortnox->orders()->create(new CreateOrderData(
    customerNumber: '1',
    rows: [
        new OrderRowData(
            articleNumber: 'SKU-001',
            deliveredQuantity: 2,
            price: 10.50,
        ),
    ],
));
```

## Invoices

```php
use Kurusa\Fortnox\Data\Invoices\CreateInvoiceData;
use Kurusa\Fortnox\Data\Invoices\InvoiceRowData;

$response = $fortnox->invoices()->list();

$response = $fortnox->invoices()->getByDocumentNumber('1001');

$response = $fortnox->invoices()->create(new CreateInvoiceData(
    customerNumber: '1',
    rows: [
        new InvoiceRowData(
            articleNumber: 'SKU-001',
            deliveredQuantity: 2,
            price: 10.50,
        ),
    ],
));

$response = $fortnox->invoices()->bookkeep('1001');
```

## Company information

```php
$response = $fortnox->companyInformation()->get();
```

## Errors

API errors throw `FortnoxApiException`.

```php
use Kurusa\Fortnox\Exceptions\FortnoxApiException;

try {
    $response = $fortnox->customers()->list();
} catch (FortnoxApiException $exception) {
    $statusCode = $exception->statusCode;
    $response = $exception->response;
}
```
