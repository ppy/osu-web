<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries;

use App\Exceptions\InvariantException;
use App\Libraries\OrderCheckout;
use App\Models\Country;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use App\Models\Tournament;
use Carbon\Carbon;
use Tests\TestCase;

// TODO: should split into Tournament-specific and generic Checkout tests.
class OrderCheckoutTest extends TestCase
{
    public function testTournamentBannerWhenAvailable()
    {
        $tournament = Tournament::factory()->create();
        $product = $this->createTournamentProduct($tournament, Carbon::now()->addDays(1));
        $orderItem = OrderItem::factory()->create([
            'product_id' => $product,
            'extra_data' => [
                'tournament_id' => $tournament->getKey(),
            ],
        ]);
        $tournament->update(['tournament_banner_product_id' => $product->getKey()]);

        $checkout = new OrderCheckout($orderItem->order);

        $this->assertEmpty($checkout->validate());
    }

    public function testTournamentBannerWhenNoEndDate()
    {
        $tournament = Tournament::factory()->create();
        $product = $this->createTournamentProduct($tournament);
        $orderItem = OrderItem::factory()->create([
            'product_id' => $product,
            'extra_data' => [
                'tournament_id' => $tournament->getKey(),
            ],
        ]);
        $tournament->update(['tournament_banner_product_id' => $product->getKey()]);

        $checkout = new OrderCheckout($orderItem->order);

        $this->assertEmpty($checkout->validate());
    }

    public function testTournamentBannerWhenNotAvailable()
    {
        $tournament = Tournament::factory()->create();
        $product = $this->createTournamentProduct($tournament, Carbon::now()->subDays(1));
        $orderItem = OrderItem::factory()->create([
            'product_id' => $product,
            'extra_data' => [
                'tournament_id' => $tournament->getKey(),
            ],
        ]);
        $tournament->update(['tournament_banner_product_id' => $product->getKey()]);

        $checkout = new OrderCheckout($orderItem->order);

        $this->assertNotEmpty($checkout->validate());
    }

    public function testShopifyItemDoesNotMix()
    {
        $product1 = Product::factory()->create(['stock' => 5, 'max_quantity' => 5, 'shopify_id' => 1]);
        $product2 = Product::factory()->create(['stock' => 5, 'max_quantity' => 5, 'shopify_id' => null]);
        $orderItem1 = OrderItem::factory()->create([
            'product_id' => $product1,
            'quantity' => 1,
        ]);

        $orderItem2 = OrderItem::factory()->create([
            'product_id' => $product2,
            'quantity' => 1,
        ]);

        $order = Order::factory()->create();
        $order->items()->save($orderItem1);
        $order->items()->save($orderItem2);

        $checkout = new OrderCheckout($order);
        $result = $checkout->validate();

        $this->assertSame(
            [osu_trans('model_validation/store/product.must_separate')],
            array_get($result, "orderItems.{$orderItem2->getKey()}")
        );
    }

    public function testTotalNonZeroDoesNotAllowFreeCheckout()
    {
        $product1 = Product::factory()->create(['stock' => 5, 'max_quantity' => 5, 'cost' => 1]);
        $orderItem1 = OrderItem::factory()->create([
            'product_id' => $product1,
            'quantity' => 1,
            'cost' => $product1->cost,
        ]);

        $order = Order::factory()->create();
        $order->items()->save($orderItem1);

        $checkout = new OrderCheckout($order, Order::PROVIDER_FREE);
        $result = $checkout->allowedCheckoutProviders();

        $this->expectException(InvariantException::class);
        $checkout->beginCheckout();

        $this->assertNotContains(Order::PROVIDER_FREE, $result);
    }

    public function testTotalZeroOnlyAllowsFreeCheckout()
    {
        $product1 = Product::factory()->create(['stock' => 5, 'max_quantity' => 5, 'cost' => 0]);
        $orderItem1 = OrderItem::factory()->create([
            'product_id' => $product1,
            'quantity' => 1,
            'cost' => $product1->cost,
        ]);

        $order = Order::factory()->create();
        $order->items()->save($orderItem1);
        $checkout = new OrderCheckout($order, Order::PROVIDER_PAYPAL);
        $result = $checkout->allowedCheckoutProviders();

        $this->expectException(InvariantException::class);
        $checkout->beginCheckout();

        $this->assertSame([Order::PROVIDER_FREE], $result);
    }

    private function createTournamentProduct(Tournament $tournament, Carbon $availableUntil = null)
    {
        $country = Country::inRandomOrder()->first() ?? Country::factory()->create();

        $product = Product::factory()->childBanners()->create([
            'available_until' => $availableUntil,
            'name' => "{$tournament->name} Support Banner ({$country->name})",
        ]);

        $type_mappings_json = [
            $product->product_id => [
                'country' => $country->acronym,
                'tournament_id' => $tournament->tournament_id,
            ],
        ];

        $product->type_mappings_json = json_encode($type_mappings_json, JSON_PRETTY_PRINT);
        $product->saveOrExplode();

        return $product;
    }
}
