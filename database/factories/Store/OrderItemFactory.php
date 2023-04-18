<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Store;

use App\Models\Store\Order;
use App\Models\Store\OrderItem;
use App\Models\Store\Product;
use Database\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'cost' => 12.0,
            'order_id' => Order::factory(),
            'product_id' => Product::factory(),
            'quantity' => 1,
        ];
    }

    public function supporterTag(): static
    {
        return $this->state([
            'cost' => 4,
            'extra_data' => function (array $attributes) {
                $user = Order::find($attributes['order_id'])->user;

                return [
                    'duration' => 1,
                    'target_id' => (string) $user->getKey(),
                    'username' => $user->username,
                ];
            },
            'product_id' => Product::customClass('supporter-tag')->first(),
        ]);
    }

    public function usernameChange(): static
    {
        return $this->state([
            'cost' => 0,
            'extra_info' => 'new_username',
            'product_id' => Product::customClass('username-change')->first(),
        ]);
    }
}
