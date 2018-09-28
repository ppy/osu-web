<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use TestCase;

class OrderTest extends TestCase
{
    public function testSwitchOrderItemReservation()
    {
        $product1 = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5]);
        $product2 = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product1->product_id,
            'quantity' => 2,
            'reserved' => true,
        ]);

        $newProductId = $product2->product_id;

        $order = $orderItem->order;
        $order->switchItems($orderItem, $product2);

        $order->refresh();
        $product1->refresh();
        $product2->refresh();

        $this->assertSame($product1->stock, 7);
        $this->assertSame($product2->stock, 3);
        $this->assertSame($order->items()->count(), 1);
        $this->assertSame($order->items->first()->product_id, $newProductId);
    }
}
