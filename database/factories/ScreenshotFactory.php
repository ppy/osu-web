<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Screenshot;
use App\Models\User;

class ScreenshotFactory extends Factory
{
    protected $model = Screenshot::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
        ];
    }
}
