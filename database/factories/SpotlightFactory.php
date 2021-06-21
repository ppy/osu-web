<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

$factory->define(App\Models\Spotlight::class, function (Faker\Generator $faker) {
    $startDate = $faker->dateTimeBetween('-6 years', 'now');
    $endDate = Carbon\Carbon::instance($startDate)->addMonths(1);

    return [
        'acronym' => 'T'.strtoupper(substr(uniqid(), 8)),
        'name' => $faker->realText(40),
        'start_date' => $startDate,
        'end_date' => $endDate,
        'mode_specific' => true,
        'type' => 'test',
        'active' => true,
    ];
});

$factory->state(App\Models\Spotlight::class, 'monthly', function (Faker\Generator $faker) {
    $chartDate = Carbon\Carbon::instance($faker->dateTimeBetween('-6 years', 'now'))->startOfMonth();

    return [
        'acronym' => function (array $self) {
            return "MONTH{$self['chart_month']->format('ym')}";
        },
        'name' => function (array $self) {
            return "Spotlight {$self['chart_month']->format('F Y')}";
        },
        'start_date' => function (array $self) {
            return ($self['chart_month'] ?? $chartDate)->copy()->addMonths(1)->addDays(rand(0, 27));
        },
        'end_date' => function (array $self) {
            return ($self['chart_month'] ?? $chartDate)->copy()->addMonths(2)->addDays(rand(0, 27));
        },
        'mode_specific' => true,
        'type' => 'monthly',
        'active' => true,
        'chart_month' => $chartDate,
    ];
});

$factory->state(App\Models\Spotlight::class, 'bestof', function (Faker\Generator $faker) {
    $chartDate = Carbon\Carbon::instance($faker->dateTimeBetween('-6 years', 'now'))->endOfYear();

    return [
        'acronym' => function (array $self) {
            return "BEST{$self['chart_month']->format('Y')}";
        },
        'name' => function (array $self) {
            return "Best of {$self['chart_month']->format('Y')}";
        },
        'start_date' => function (array $self) {
            return ($self['chart_month'] ?? $chartDate)->copy()->startOfMonth()->addMonths(1)->addDays(rand(0, 27));
        },
        'end_date' => function (array $self) {
            return ($self['chart_month'] ?? $chartDate)->copy()->startOfMonth()->addMonths(2)->addDays(rand(0, 27));
        },
        'mode_specific' => true,
        'type' => 'bestof',
        'active' => true,
        'chart_month' => $chartDate,
    ];
});
