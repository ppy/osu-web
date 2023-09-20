<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use App\Models\UserDonation;

class UserDonationFactory extends Factory
{
    protected $model = UserDonation::class;

    public function definition(): array
    {
        return [
            'amount' => 4,
            'cancel' => false,
            'length' => 1,
            'transaction_id' => fn () => $this->transactionId(),
            'user_id' => User::factory(),

            'target_user_id' => fn (array $attr) => $attr['user_id'],
        ];
    }

    public function cancelled(): static
    {
        return $this->state([
            'cancel' => true,
            'transaction_id' => fn () => "{$this->transactionId()}-cancel",
        ]);
    }

    private function transactionId(): string
    {
        return 'faked-'.time().'-'.$this->faker->randomNumber();
    }
}
