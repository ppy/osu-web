<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Tests\Libraries\Store;

use App\Libraries\Store\ShopifyOrder;
use App\Models\Store\Order;
use Tests\TestCase;

class ShopifyOrderTest extends TestCase
{
    private const AUTHORIZED = [
        'financialStatus' => 'AUTHORIZED',
        'fulfillmentStatus' => 'UNFULFILLED'
    ];

    private const CANCELLED = [
        'canceledAt' => '2025-01-23T01:23:45Z',
        'financialStatus' => 'AUTHORIZED',
        'fulfillmentStatus' => 'FULFILLED'
    ];

    private const FULFILLED = [
        'financialStatus' => 'PAID',
        'fulfillmentStatus' => 'FULFILLED'
    ];

    private const PAID = [
        'financialStatus' => 'PAID',
        'fulfillmentStatus' => 'UNFULFILLED'
    ];

    public static function dataProviderForUpdateOrderStatus()
    {
        return [
            [static::baseResponse(static::AUTHORIZED), Order::STATUS_PAYMENT_APPROVED],
            [static::baseResponse(static::CANCELLED), Order::STATUS_CANCELLED],
            [static::baseResponse(static::PAID), Order::STATUS_PAID],
            [static::baseResponse(static::FULFILLED), Order::STATUS_SHIPPED],
        ];
    }

    private static function baseResponse(array $extra)
    {
        return [
            'canceledAt' => NULL,
            'id' => 'gid://shopify/Order/1',
            'orderNumber' => 123,
            'processedAt' => '2025-01-23T01:23:45Z',
            'statusUrl' => 'not_a_real_url?key=foo',
            ...$extra,
        ];
    }

    /**
     * @dataProvider dataProviderForUpdateOrderStatus
     *
     * @param array $node
     * @param string $expectedStatus
     * @return void
     */
    public function testUpdateOrderStatus(array $node, string $expectedStatus)
    {
        $order = Order::factory()->shopify()->checkout()->state(['reference' => 'gid://shopify/Cart/1'])->create();
        $shopifyOrder = new ShopifyOrder($order);

        $shopifyOrder->updateOrderWithGql($node);

        $order->refresh();
        $this->assertSame($expectedStatus, $order->status);
        $this->assertSame($node['id'], $order->reference);
        $this->assertSame($node['orderNumber'], (int) $order->getTransactionId());
        $this->assertSame($node['statusUrl'], $order->shopify_url);
    }

    public function testUpdateOrderWithGqlFailsNonShopify()
    {
        $order = Order::factory()->checkout()->create();

        $this->expectException(\Exception::class);

        new ShopifyOrder($order);
    }
}
