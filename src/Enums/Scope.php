<?php

namespace Kurusa\Fortnox\Enums;

enum Scope: string
{
    case Article = 'article';
    case CompanyInformation = 'companyinformation';
    case Customer = 'customer';
    case Invoice = 'invoice';
    case Order = 'order';

    public static function format(array $scopes): string
    {
        return implode(' ', array_map(
            static fn(self $scope): string => $scope->value,
            $scopes,
        ));
    }
}
