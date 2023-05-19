<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BeatmapMirror;

class BeatmapMirrorFactory extends Factory
{
    protected $model = BeatmapMirror::class;

    public function default(): static
    {
        return $this->state([
            'mirror_id' => config('osu.beatmap_processor.mirrors_to_use')[0],
        ]);
    }

    public function definition(): array
    {
        return [
            'base_url' => 'http://beatmap-download.test/',
            'traffic_used' => rand(0, pow(2, 32)),
            'secret_key' => fn() => $this->faker->password(),
            'provider_user_id' => 2,
            'enabled' => 1,
            'version' => BeatmapMirror::MIN_VERSION_TO_USE,
        ];
    }
}
