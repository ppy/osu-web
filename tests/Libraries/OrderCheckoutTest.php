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
        $tournament = factory(Tournament::class)->create();
        $product = $this->createTournamentProduct($tournament, Carbon::now()->addDay(1));
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
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
        $tournament = factory(Tournament::class)->create();
        $product = $this->createTournamentProduct($tournament);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
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
        $tournament = factory(Tournament::class)->create();
        $product = $this->createTournamentProduct($tournament, Carbon::now()->subDay(1));
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
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
        $product1 = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5, 'shopify_id' => 1]);
        $product2 = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5, 'shopify_id' => null]);
        $orderItem1 = factory(OrderItem::class)->create([
            'product_id' => $product1->product_id,
            'quantity' => 1,
        ]);

        $orderItem2 = factory(OrderItem::class)->create([
            'product_id' => $product2->product_id,
            'quantity' => 1,
        ]);

        $order = factory(Order::class)->create();
        $order->items()->save($orderItem1);
        $order->items()->save($orderItem2);

        $checkout = new OrderCheckout($order);
        $result = $checkout->validate();

        $this->assertSame(
            [trans('model_validation/store/product.must_separate')],
            array_get($result, "orderItems.{$orderItem2->getKey()}")
        );
    }

    public function testTotalNonZeroDoesNotAllowFreeCheckout()
    {
        $product1 = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5, 'cost' => 1]);
        $orderItem1 = factory(OrderItem::class)->create([
            'product_id' => $product1->product_id,
            'quantity' => 1,
            'cost' => $product1->cost,
        ]);

        $order = factory(Order::class)->create();
        $order->items()->save($orderItem1);

        $checkout = new OrderCheckout($order, Order::PROVIDER_FREE);
        $result = $checkout->allowedCheckoutProviders();

        $this->expectException(InvariantException::class);
        $checkout->beginCheckout();

        $this->assertNotContains(Order::PROVIDER_FREE, $result);
    }

    public function testTotalZeroOnlyAllowsFreeCheckout()
    {
        $product1 = factory(Product::class)->create(['stock' => 5, 'max_quantity' => 5, 'cost' => 0]);
        $orderItem1 = factory(OrderItem::class)->create([
            'product_id' => $product1->product_id,
            'quantity' => 1,
            'cost' => $product1->cost,
        ]);

        $order = factory(Order::class)->create();
        $order->items()->save($orderItem1);
        $checkout = new OrderCheckout($order, Order::PROVIDER_PAYPAL);
        $result = $checkout->allowedCheckoutProviders();

        $this->expectException(InvariantException::class);
        $checkout->beginCheckout();

        $this->assertSame([Order::PROVIDER_FREE], $result);
    }

    private function createTournamentProduct(Tournament $tournament, Carbon $availableUntil = null)
    {
        $country = Country::inRandomOrder()->first() ?? factory(Country::class)->create();

        $product = factory(Product::class, 'child_banners')->create([
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
