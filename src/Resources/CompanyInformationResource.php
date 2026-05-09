<?php

namespace Kurusa\Fortnox\Resources;

use Kurusa\Fortnox\Responses\CompanyInformation\CompanyInformationResponse;

final readonly class CompanyInformationResource extends Resource
{
    public function get(): CompanyInformationResponse
    {
        $raw = $this->client->get('companyinformation');

        return CompanyInformationResponse::fromRawResponse($raw->statusCode, $raw->data);
    }
}
