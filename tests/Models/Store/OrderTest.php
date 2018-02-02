<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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

namespace Tests;

use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use TestCase;

class OrderTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->order = factory(Order::class)->states('incart')->create();
    }

    public function testDisabledItemsShouldBeRemoved()
    {
        $product = factory(Product::class)->states('disabled')->create();
        factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'order_id' => $this->order->order_id,
            'quantity' => 1,
        ]);

        $this->assertSame(1, $this->order->items->count());
        $this->order->removeInvalidItems();
        $order = $this->order->fresh();
        $this->assertSame(0, $order->items->count());
    }

    public function testInsufficientStockShouldBeReduced()
    {
        $product = factory(Product::class)->create(['stock' => 1]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'order_id' => $this->order->order_id,
            'quantity' => 2,
        ]);

        $this->assertSame(2, $orderItem->quantity);
        $this->order->removeInvalidItems();
        $order = $this->order->fresh();
        $this->assertSame(1, $order->items->first()->quantity);
    }
}
