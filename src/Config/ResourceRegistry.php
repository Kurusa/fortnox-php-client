<?php

namespace Kurusa\Fortnox\Config;

use Kurusa\Fortnox\Resources\AccountsResource;
use Kurusa\Fortnox\Resources\ArticlesResource;
use Kurusa\Fortnox\Resources\CompanyInformationResource;
use Kurusa\Fortnox\Resources\CustomersResource;
use Kurusa\Fortnox\Resources\InvoicesResource;
use Kurusa\Fortnox\Resources\OrdersResource;

final readonly class ResourceRegistry
{
    public static function default(): array
    {
        return [
            'articles' => ArticlesResource::class,
            'companyInformation' => CompanyInformationResource::class,
            'customers' => CustomersResource::class,
            'invoices' => InvoicesResource::class,
            'orders' => OrdersResource::class,
            'accounts' => AccountsResource::class,
        ];
    }
}
