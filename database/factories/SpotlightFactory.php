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

$factory->defineAs(App\Models\Spotlight::class, 'month', function (Faker\Generator $faker) {
    $startDate = $faker->dateTimeBetween('-6 years', 'now');
    $endDate = Carbon\Carbon::instance($startDate)->addMonths(1);

    return  [
        'acronym' => "MONTH{$endDate->format('ym')}",
        'name' => "Spotlight {$endDate->format('F Y')}",
        'start_date' => $startDate,
        'end_date' => $endDate,
        'mode_specific' => true,
        'type' => 'monthly',
        'active' => true,
    ];
});
