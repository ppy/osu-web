<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Chat;

use App\Models\Chat\Channel;
use App\Models\Chat\UserChannel;
use App\Models\User;
use Database\Factories\Factory;

class UserChannelFactory extends Factory
{
    protected $model = UserChannel::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'channel_id' => Channel::factory(),
        ];
    }
}
