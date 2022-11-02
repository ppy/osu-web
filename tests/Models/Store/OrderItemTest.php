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
    public function testDelete(string $status, ?string $expectedException)
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(5, false);

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
        [$product, $orderItem] = $this->createProductAndOrderItem(5, false);

        $orderItem->reserveProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertTrue($orderItem->reserved);
        $this->assertSame($product->stock, 3);
    }

    public function testReserveReservedProduct()
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(5, true);

        $orderItem->reserveProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertTrue($orderItem->reserved);
        $this->assertSame($product->stock, 5);
    }

    public function testReleaseUnreservedProduct()
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(5, false);

        $orderItem->releaseProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertFalse($orderItem->reserved);
        $this->assertSame($product->stock, 5);
    }

    public function testReleaseReservedProduct()
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(5, true);

        $orderItem->releaseProduct();

        $orderItem->refresh();
        $product->refresh();

        $this->assertFalse($orderItem->reserved);
        $this->assertSame($product->stock, 7);
    }

    public function testReserveInsufficientStock()
    {
        [, $orderItem] = $this->createProductAndOrderItem(1, false);

        $this->expectException(InsufficientStockException::class);
        $orderItem->reserveProduct();
    }

    public function testReleaseWhenStockIsZero()
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(0, true);

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

    private function createProductAndOrderItem(int $stock, bool $reserved)
    {
        $product = factory(Product::class)->create(['stock' => $stock, 'max_quantity' => 5]);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->getKey(),
            'quantity' => 2,
            'reserved' => $reserved,
        ]);

        return [$product, $orderItem];
    }
}
