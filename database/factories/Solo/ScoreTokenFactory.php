<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories\Solo;

use App\Models\Beatmap;
use App\Models\Build;
use App\Models\Solo\ScoreToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreTokenFactory extends Factory
{
    protected $model = ScoreToken::class;

    public function definition(): array
    {
        return [
            'beatmap_id' => Beatmap::factory()->ranked(),
            'build_id' => Build::factory(),
            'user_id' => User::factory(),

            // depends on beatmap_id
            'ruleset_id' => fn (array $attr) => Beatmap::find($attr['beatmap_id'])->playmode,
        ];
    }
}
