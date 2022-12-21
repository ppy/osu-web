<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Store;

use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function testContainsSupporterTag()
    {
        $order = factory(Order::class)->create();
        $product = factory(Product::class)->create();
        factory(OrderItem::class)->create(['order_id' => $order, 'product_id' => $product]);
        factory(OrderItem::class)->states('supporter_tag')->create(['order_id' => $order]);

        $this->assertTrue($order->containsSupporterTag());
    }

    public function testIsHideSupporterFromActivity()
    {
        $order = factory(Order::class)->create();
        factory(OrderItem::class, 2)->states('supporter_tag')->create(['order_id' => $order]);

        $this->assertFalse($order->isHideSupporterFromActivity());

        $order->items[0]->extra_data->hidden = true;
        $order->saveOrExplode();

        $this->assertTrue($order->isHideSupporterFromActivity());
    }

    public function testSetGiftsHidden()
    {
        $order = factory(Order::class)->create();
        factory(OrderItem::class, 2)->states('supporter_tag')->create(['order_id' => $order]);

        $order->setGiftsHidden(true);
        OrderItem::each(fn ($item) => $this->assertTrue($item->extra_data->hidden));

        $order->setGiftsHidden(false);
        OrderItem::each(fn ($item) => $this->assertFalse($item->extra_data->hidden));
    }

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
