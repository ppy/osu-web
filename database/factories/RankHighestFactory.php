<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Beatmap;
use App\Models\RankHighest;
use App\Models\User;

class RankHighestFactory extends Factory
{
    protected $model = RankHighest::class;

    public function definition(): array
    {
        return [
            'mode' => array_rand_val(Beatmap::MODES),
            'rank' => rand(1, 10000),
            'user_id' => User::factory(),
        ];
    }
}
