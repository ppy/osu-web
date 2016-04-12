<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\Country::class, function (Faker\Generator $faker) {
    $acronym = $faker->unique()->countryCode;

    while (App\Models\Country::where('acronym', $acronym)->count() > 0 || strlen($acronym) < 2) {
        $acronym = $faker->unique()->countryCode;
    }

    // Get the country name from the countries list
    if (trans('countries.'.$acronym)) {
        $country = trans('countries.'.$acronym);
    } else {
        $country = $faker->unique()->catchPhrase;
    }


    echo $country . ' , ' . $acronym . ' | ';


    return  [
        'acronym' => $acronym,
        'name' => $country,
        'rankedscore' => rand(5000000, 500000000) * 10000,
        'playcount' => rand(10000000, 200000000),
        'usercount' => rand(10000, 600000),
        'pp' => rand(1000000, 45000000),
    ];
});
