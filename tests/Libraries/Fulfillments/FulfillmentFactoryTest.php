<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

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
        $orderItem = factory(OrderItem::class, 'supporter_tag')->create();
        $order = $orderItem->order;

        $fulfillers = FulfillmentFactory::createFulfillersFor($order);
        $this->assertSame(1, count($fulfillers));
        $this->assertSame(SupporterTagFulfillment::class, get_class($fulfillers[0]));
    }

    public function testCustomClassUsernameChange()
    {
        $orderItem = factory(OrderItem::class, 'username_change')->create();
        $order = $orderItem->order;

        $fulfillers = FulfillmentFactory::createFulfillersFor($order);
        $this->assertSame(1, count($fulfillers));
        $this->assertSame(UsernameChangeFulfillment::class, get_class($fulfillers[0]));
    }

    public function testCustomClassBanner()
    {
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => factory(Product::class)->create(['custom_class' => 'mwc7-supporter'])->product_id,
        ]);
        $order = $orderItem->order;

        $fulfillers = FulfillmentFactory::createFulfillersFor($order);
        $this->assertSame(1, count($fulfillers));
        $this->assertSame(Mwc7SupporterFulfillment::class, get_class($fulfillers[0]));
    }

    public function testCustomClassDoesNotExist()
    {
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => factory(Product::class)->create(['custom_class' => 'derp-derp'])->product_id,
        ]);
        $order = $orderItem->order;

        $this->expectException(InvalidFulfillerException::class);

        FulfillmentFactory::createFulfillersFor($order);
    }
}
