<?php

$factory->define(App\Models\Spotlight::class, function (Faker\Generator $faker) {
    $startDate = $faker->dateTimeBetween('-6 years', 'now');
    $endDate = Carbon\Carbon::instance($startDate)->addMonths(1);

    return  [
        'acronym' => 'T'.strtoupper(substr(uniqid(), 8)),
        'name' => $faker->realText(40),
        'start_date' => $startDate,
        'end_date' => $endDate,
        'mode_specific' => true,
        'type' => 'test',
        'active' => true,
    ];
});

$factory->defineAs(App\Models\Spotlight::class, 'monthly', function (Faker\Generator $faker) {
    $startDate = Carbon\Carbon::instance($faker->dateTimeBetween('-6 years', 'now'));
    $endDate = Carbon\Carbon::instance($startDate)->addMonths(1);

    return  [
        // Monthly Spotlight is generated for the previous month.
        'acronym' => function (array $self) {
            $date = $self['start_date']->copy()->subMonths(1);

            return "MONTH{$date->format('ym')}";
        },
        'name' => function (array $self) {
            $date = $self['start_date']->copy()->subMonths(1);

            return "Spotlight {$date->format('F Y')}";
        },
        'start_date' => $startDate,
        'end_date' => $endDate,
        'mode_specific' => true,
        'type' => 'monthly',
        'active' => true,
    ];
});

$factory->defineAs(App\Models\Spotlight::class, 'yearly', function (Faker\Generator $faker) {
    $startDate = Carbon\Carbon::instance($faker->dateTimeBetween('-6 years', 'now'))->endOfYear()->addMonths(1);
    $endDate = $startDate->copy()->addMonths(1);

    return  [
        // Monthly Spotlight is generated for the previous month.
        'acronym' => function (array $self) {
            $date = $self['start_date']->copy()->subYears(1);

            return "BEST{$date->format('Y')}";
        },
        'name' => function (array $self) {
            $date = $self['start_date']->copy()->subYears(1);

            return "Best of {$date->format('Y')}";
        },
        'start_date' => $startDate,
        'end_date' => $endDate,
        'mode_specific' => true,
        'type' => 'yearly',
        'active' => true,
    ];
});
