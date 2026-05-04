<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\ValueObjects\FortnoxResponse;

final readonly class CompanyInformationResource extends Resource
{
    public function get(): FortnoxResponse
    {
        return $this->client->get('companyinformation');
    }
}
