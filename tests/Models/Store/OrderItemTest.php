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
        [, $orderItem] = $this->createProductAndOrderItem(5, false);

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

        $this->expectCountChange(fn () => $product->fresh()->stock, -2);

        $orderItem->reserveProduct();

        $this->assertTrue($orderItem->fresh()->reserved);
    }

    public function testReserveReservedProduct()
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(5, true);

        $this->expectCountChange(fn () => $product->fresh()->stock, 0);

        $orderItem->reserveProduct();

        $this->assertTrue($orderItem->fresh()->reserved);
    }

    public function testReleaseUnreservedProduct()
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(5, false);

        $this->expectCountChange(fn () => $product->fresh()->stock, 0);

        $orderItem->releaseProduct();

        $this->assertFalse($orderItem->fresh()->reserved);
    }

    public function testReleaseReservedProduct()
    {
        [$product, $orderItem] = $this->createProductAndOrderItem(5, true);

        $this->expectCountChange(fn () => $product->fresh()->stock, 2);

        $orderItem->releaseProduct();

        $this->assertFalse($orderItem->fresh()->reserved);
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

        $this->expectCountChange(fn () => $product->fresh()->stock, 0);

        $orderItem->releaseProduct();

        $this->assertFalse($orderItem->fresh()->reserved);
    }

    public static function deleteDataProvider()
    {
        return [
            ['checkout', InvariantException::class],
            ['incart', null],
            ['processing', InvariantException::class],
        ];
    }

    private function createProductAndOrderItem(int $stock, bool $reserved)
    {
        $product = Product::factory()->create(['stock' => $stock, 'max_quantity' => 5]);
        $orderItem = OrderItem::factory()->create([
            'product_id' => $product,
            'quantity' => 2,
            'reserved' => $reserved,
        ]);

        return [$product, $orderItem];
    }
}
