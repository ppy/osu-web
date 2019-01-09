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

use App\Exceptions\InsufficientStockException;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use TestCase;

class OrderItemTest extends TestCase
{
    public function testReserveUnreservedProduct()
    {
        $product = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'quantity' => 2,
            'reserved' => false,
        ]);

        $orderItem->reserveProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertTrue($orderItem->reserved);
        $this->assertSame($product->stock, 3);
    }

    public function testReserveReservedProduct()
    {
        $product = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'quantity' => 2,
            'reserved' => true,
        ]);

        $orderItem->reserveProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertTrue($orderItem->reserved);
        $this->assertSame($product->stock, 5);
    }

    public function testReleaseUnreservedProduct()
    {
        $product = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'quantity' => 2,
            'reserved' => false,
        ]);

        $orderItem->releaseProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertFalse($orderItem->reserved);
        $this->assertSame($product->stock, 5);
    }

    public function testReleaseReservedProduct()
    {
        $product = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'quantity' => 2,
            'reserved' => true,
        ]);

        $orderItem->releaseProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertFalse($orderItem->reserved);
        $this->assertSame($product->stock, 7);
    }

    public function testReserveInsufficientStock()
    {
        $product = factory(Product::class)->create(['stock' => 1, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'quantity' => 2,
            'reserved' => false,
        ]);

        $this->expectException(InsufficientStockException::class);
        $orderItem->reserveProduct();
    }

    public function testReleaseWhenStockIsZero()
    {
        $product = factory(Product::class)->create(['stock' => 0, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'quantity' => 2,
            'reserved' => true,
        ]);

        $orderItem->releaseProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertFalse($orderItem->reserved);
        $this->assertSame($product->stock, 0);
    }
}
