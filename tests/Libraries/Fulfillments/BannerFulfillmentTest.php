<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Fulfillments;

use App\Libraries\Fulfillments\BannerFulfillment;
use App\Libraries\Fulfillments\FulfillmentFactory;
use App\Models\Country;
use App\Models\ProfileBanner;
use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use App\Models\Tournament;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\ModelSeeders\ProductSeeder;
use Tests\TestCase;

class BannerFulfillmentTest extends TestCase
{
    private function findOrSeed()
    {
        // TODO: factory that creates related items properly? or just use fixtures.
        $product = Product::customClass('mwc7-supporter')->orderBy('product_id', 'desc')->first();
        if ($product) {
            $matches = [];
            preg_match('/.+\((?<country>.+)\)$/', $this->product->name, $matches);
            $country = Country::where('name', $matches['country'])->first();
        } else {
            $country = factory(Country::class)->create();
            (new ProductSeeder())->seedBanners();
            $product = Product::customClass('mwc7-supporter')->orderBy('product_id', 'desc')->first();
        }

        $this->product = $product;
        $this->country = $country;
    }

    public function testAddBanner()
    {
        $orderItem = $this->createOrderItem($this->product);
        // BannerFulfillment is abstract, so can't new directly.
        $subjects = FulfillmentFactory::createFulfillersFor($this->order);
        $beforeCount = ProfileBanner::where('user_id', $this->user->user_id)
            ->where('tournament_id', $this->tournament->tournament_id)
            ->where('country_acronym', $this->country->acronym)
            ->count();

        foreach ($subjects as $subject) {
            $subject->run();
        }

        $afterCount = ProfileBanner::where('user_id', $this->user->user_id)
            ->where('tournament_id', $this->tournament->tournament_id)
            ->where('country_acronym', $this->country->acronym)
            ->count();

        $this->assertSame($beforeCount + 1, $afterCount);
    }

    public function testBannerCustomClasses()
    {
        static $customClasses = BannerFulfillment::ALLOWED_TAGGED_NAMES;
        foreach ($customClasses as $customClass) {
            // only need the custom_class
            $product = factory(Product::class)->create(['custom_class' => $customClass]);
            $orderItem = factory(OrderItem::class)->create([
                'product_id' => $product->product_id,
                'order_id' => $this->order->order_id,
                'cost' => $product->cost,
            ]);
        }

        $subjects = FulfillmentFactory::createFulfillersFor($this->order);

        $this->assertSame(count($customClasses), count($subjects));
    }

    public function testInvalidBannerCustomClasss()
    {
        $product = factory(Product::class)->create(['custom_class' => 'invalid-supporter']);
        $orderItem = factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'order_id' => $this->order->order_id,
            'cost' => $product->cost,
        ]);

        $this->expectException(\App\Libraries\Fulfillments\InvalidFulfillerException::class);
        $subjects = FulfillmentFactory::createFulfillersFor($this->order);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = factory(User::class)->create([
            'osu_featurevotes' => 0,
            'osu_subscriptionexpiry' => Carbon::now(),
        ]);

        $this->order = factory(Order::class)->states('paid')->create([
            'user_id' => $this->user->user_id,
        ]);

        // crap test
        $this->tournament = factory(Tournament::class)->create();
        $this->product = Product::customClass('mwc7-supporter')->orderBy('product_id', 'desc')->first();
        $this->findOrSeed();
    }

    private function createOrderItem($product)
    {
        return factory(OrderItem::class)->create([
            'product_id' => $product->product_id,
            'order_id' => $this->order->order_id,
            'cost' => $product->cost,
            'extra_data' => [
                'tournament_id' => $this->tournament->tournament_id,
                'cc' => $this->country->acronym,
            ],
        ]);
    }
}
