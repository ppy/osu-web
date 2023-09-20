<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Spotlight;
use Carbon\Carbon;

class SpotlightFactory extends Factory
{
    protected $model = Spotlight::class;

    public function configure(): static
    {
        return $this->afterMaking(function (Spotlight $spotlight) {
            $spotlight->end_date ??= $spotlight->start_date?->addMonths(1)->addDays(rand(0, 27));
        });
    }

    public function definition(): array
    {
        return [
            'acronym' => 'T'.strtoupper(substr(uniqid(), 8)),
            'active' => true,
            'mode_specific' => true,
            'name' => fn () => $this->faker->realText(40),
            'start_date' => fn () => $this->faker->dateTimeBetween('-6 years'),
            'type' => 'test',
        ];
    }

    public function monthly(): static
    {
        $chartMonth = Carbon::instance($this->faker->dateTimeBetween('-6 years'))->startOfMonth();

        return $this->state([
            'active' => true,
            'chart_month' => $chartMonth,
            'mode_specific' => true,
            'type' => 'monthly',

            'acronym' => fn (array $attr) => "MONTH{$attr['chart_month']->format('ym')}",
            'name' => fn (array $attr) => "Spotlight {$attr['chart_month']->format('F Y')}",
            'start_date' => fn (array $attr) => $attr['chart_month']->copy()->addMonths(1)->addDays(rand(0, 27)),
        ]);
    }

    public function bestof(): static
    {
        $chartMonth = Carbon::instance($this->faker->dateTimeBetween('-6 years'))->endOfYear();

        return [
            'active' => true,
            'chart_month' => $chartMonth,
            'mode_specific' => true,
            'type' => 'bestof',

            'acronym' => fn (array $attr) => "BEST{$attr['chart_month']->format('Y')}",
            'name' => fn (array $attr) => "Best of {$attr['chart_month']->format('Y')}",
            'start_date' => fn (array $attr) => $attr['chart_month']->copy()->addMonths(1)->addDays(rand(0, 27)),
        ];
    }
}
