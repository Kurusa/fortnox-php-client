<?php

namespace Kurusa\Fortnox\Tests\Unit\Orders;

use Kurusa\Fortnox\Data\Orders\CreateOrderData;
use Kurusa\Fortnox\Data\Orders\OrderRowData;
use PHPUnit\Framework\TestCase;

final class CreateOrderDataTest extends TestCase
{
    public function test_it_serializes_full_order_payload(): void
    {
        $data = new CreateOrderData(
            customerNumber: '123',
            rows: [
                OrderRowData::article(
                    articleNumber: 'A-1',
                    description: 'Article row',
                    price: 150,
                    accountNumber: '3001',
                ),
                OrderRowData::text('Text row'),
            ],
            ourReference: 'Our ref',
            yourOrderNumber: 'Order ref',
            yourReference: 'Your ref',
            deliveryDate: '2026-05-06',
            remarks: 'Comment',
            freight: 49,
            wayOfDelivery: 'DHL',
            deliveryName: 'Delivery name',
            deliveryAddress1: 'Street 1',
            deliveryAddress2: 'Floor 2',
            deliveryCity: 'Stockholm',
            deliveryZipCode: '111 22',
            phone1: '123456',
            emailAddressTo: 'customer@example.test',
        );

        $this->assertSame([
            'Order' => [
                'CustomerNumber' => '123',
                'OurReference' => 'Our ref',
                'YourOrderNumber' => 'Order ref',
                'YourReference' => 'Your ref',
                'DeliveryDate' => '2026-05-06',
                'Remarks' => 'Comment',
                'Freight' => 49.0,
                'WayOfDelivery' => 'DHL',
                'DeliveryName' => 'Delivery name',
                'DeliveryAddress1' => 'Street 1',
                'DeliveryAddress2' => 'Floor 2',
                'DeliveryCity' => 'Stockholm',
                'DeliveryZipCode' => '111 22',
                'Phone1' => '123456',
                'EmailInformation' => [
                    'EmailAddressTo' => 'customer@example.test',
                ],
                'OrderRows' => [
                    [
                        'ArticleNumber' => 'A-1',
                        'DeliveredQuantity' => 1.0,
                        'Description' => 'Article row',
                        'Price' => 150.0,
                        'OrderedQuantity' => 1.0,
                        'Unit' => '',
                        'AccountNumber' => '3001',
                    ],
                    [
                        'ArticleNumber' => '',
                        'DeliveredQuantity' => 0.0,
                        'Description' => 'Text row',
                        'Price' => 0.0,
                        'OrderedQuantity' => 0.0,
                        'Unit' => '',
                        'AccountNumber' => '0',
                    ],
                ],
            ],
        ], $data->toArray());
    }
}
