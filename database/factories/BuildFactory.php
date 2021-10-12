<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Database\Factories;

use App\Models\Build;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuildFactory extends Factory
{
    protected $model = Build::class;

    public function definition(): array
    {
        return [
            'date' => fn () => $this->faker->dateTimeBetween('-5 years'),
            'hash' => fn () => md5($this->faker->word(), true),
            'stream_id' => fn () => array_rand_val(config('osu.changelog.update_streams')),
            'users' => rand(100, 10000),

            // the default depends on date
            'version' => fn (array $attr) => (
                isset($attr['date'])
                ? Carbon::instance($attr['date'])->format('Ymd')
                : null
            ),
        ];
    }
}
