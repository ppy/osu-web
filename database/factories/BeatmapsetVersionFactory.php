<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Beatmapset;
use App\Models\BeatmapsetVersion;

class BeatmapsetVersionFactory extends Factory
{
    protected $model = BeatmapsetVersion::class;

    public function definition(): array
    {
        return [
            'beatmapset_id' => Beatmapset::factory(),
        ];
    }
}
