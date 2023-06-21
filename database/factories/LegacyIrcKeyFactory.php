<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LegacyIrcKey;
use App\Models\User;

class LegacyIrcKeyFactory extends Factory
{
    protected $model = LegacyIrcKey::class;

    public function definition(): array
    {
        return [
            'token' => bin2hex(random_bytes(4)),
            'user_id' => User::factory(),
        ];
    }
}
