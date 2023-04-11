<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Store;

use App\Models\Store\Order;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function checkout(): static
    {
        return $this->state(['status' => 'checkout']);
    }

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
        ];
    }

    public function paid(): static
    {
        $date = Carbon::now();

        return $this->state([
            'paid_at' => $date,
            'status' => 'paid',
            'transaction_id' => "test-{$date->timestamp}",
        ]);
    }

    public function incart(): static
    {
        return $this->state(['status' => 'incart']);
    }

    public function processing(): static
    {
        return $this->state(['status' => 'processing']);
    }

    public function shipped(): static
    {
        return $this->state(['status' => 'shipped']);
    }

    public function shopify(): static
    {
        return $this->state([
            // Doesn't need to be a gid for tests.
            'transaction_id' => Order::PROVIDER_SHOPIFY.'-'.time(),
        ]);
    }
}
