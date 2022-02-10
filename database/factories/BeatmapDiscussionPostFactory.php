<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\BeatmapDiscussionPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BeatmapDiscussionPostFactory extends Factory
{
    protected $model = BeatmapDiscussionPost::class;

    public function definition(): array
    {
        return [
            'message' => fn () => $this->faker->sentence(10),
        ];
    }

    public function timeline()
    {
        return $this->state([
            'message' => "00:00.000 {$this->faker->sentence(10)}",
        ]);
    }
}
