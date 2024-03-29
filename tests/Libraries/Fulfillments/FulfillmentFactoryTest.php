<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Fulfillments;

use App\Libraries\Fulfillments\FulfillmentFactory;
use App\Libraries\Fulfillments\InvalidFulfillerException;
use App\Libraries\Fulfillments\Mwc7SupporterFulfillment;
use App\Libraries\Fulfillments\SupporterTagFulfillment;
use App\Libraries\Fulfillments\UsernameChangeFulfillment;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use Tests\TestCase;

class FulfillmentFactoryTest extends TestCase
{
    public function testCustomClassSupporterTag()
    {
        $orderItem = OrderItem::factory()->supporterTag()->create();
        $order = $orderItem->order;

        $fulfillers = FulfillmentFactory::createFulfillersFor($order);
        $this->assertSame(1, count($fulfillers));
        $this->assertSame(SupporterTagFulfillment::class, get_class($fulfillers[0]));
    }

    public function testCustomClassUsernameChange()
    {
        $orderItem = OrderItem::factory()->usernameChange()->create();
        $order = $orderItem->order;

        $fulfillers = FulfillmentFactory::createFulfillersFor($order);
        $this->assertSame(1, count($fulfillers));
        $this->assertSame(UsernameChangeFulfillment::class, get_class($fulfillers[0]));
    }

    public function testCustomClassBanner()
    {
        $orderItem = OrderItem::factory()->create([
            'product_id' => Product::factory()->create(['custom_class' => 'mwc7-supporter']),
        ]);
        $order = $orderItem->order;

        $fulfillers = FulfillmentFactory::createFulfillersFor($order);
        $this->assertSame(1, count($fulfillers));
        $this->assertSame(Mwc7SupporterFulfillment::class, get_class($fulfillers[0]));
    }

    public function testCustomClassDoesNotExist()
    {
        $orderItem = OrderItem::factory()->create([
            'product_id' => Product::factory()->create(['custom_class' => 'derp-derp']),
        ]);
        $order = $orderItem->order;

        $this->expectException(InvalidFulfillerException::class);

        FulfillmentFactory::createFulfillersFor($order);
    }
}
