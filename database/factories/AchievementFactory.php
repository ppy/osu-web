<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Achievement;

class AchievementFactory extends Factory
{
    const GROUPINGS = ['Misc Achievements 1', 'Misc Achievements 2'];

    const SLUGS = [
        'all-packs-anime-1',
        'all-packs-anime-2',
        'all-packs-gamer-1',
        'all-packs-gamer-2',
        'all-packs-rhythm-1',
        'all-packs-rhythm-2',
        'osu-combo-500',
        'osu-combo-750',
        'osu-combo-1000',
        'osu-combo-2000',
    ];

    protected $model = Achievement::class;

    public function definition(): array
    {
        return [
            'achievement_id' => fn () => $this->faker->unique()->numberBetween(1, 5000),
            'description' => fn () => $this->faker->realText(30),
            'grouping' => array_rand_val(static::GROUPINGS),
            'image' => 'http://s.ppy.sh/images/achievements/gamer2.png',
            'name' => fn () => substr($this->faker->catchPhrase(), 0, 40),
            'ordering' => 0,
            'progression' => 0,
            'quest_instructions' => fn () => $this->faker->realText(30),
            'slug' => array_rand_val(static::SLUGS),
        ];
    }
}
