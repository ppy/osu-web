<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Models\Store;

use App\Exceptions\InsufficientStockException;
use App\Exceptions\InvariantException;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    /**
     * @dataProvider deleteDataProvider
     */
    public function testDelete(string $status, $expectedException)
    {
        $product = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'quantity' => 2,
            'reserved' => false,
        ]);

        $orderItem->order->update(['status' => $status]);

        if ($expectedException === null) {
            $this->expectNotToPerformAssertions();
        } else {
            $this->expectException($expectedException);
        }

        $orderItem->delete();
    }

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

    public function deleteDataProvider()
    {
        return [
            ['checkout', InvariantException::class],
            ['incart', null],
            ['processing', InvariantException::class],
        ];
    }
}
