<?php

use App\Models\User;
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

$factory->defineAs(App\Models\Forum\Forum::class, 'parent', function (Faker\Generator $faker) {
    return  [
        'forum_name' => $faker->catchPhrase,
        'forum_desc' => $faker->realtext(80),
        'forum_type' => 0,
    ];
});

$factory->defineAs(App\Models\Forum\Forum::class, 'child', function (Faker\Generator $faker) {
    return  [
        'forum_name' => $faker->catchPhrase,
        'forum_desc' => $faker->realtext(80),
        'forum_type' => 1,
    ];
});

$factory->define(App\Models\Forum\Topic::class, function (Faker\Generator $faker) {
  $u = User::orderByRaw('RAND()')->first();

    return  [
        'topic_poster' => $u->user_id,
        'topic_first_poster_name' => $u->username,
        'topic_title' => $faker->catchPhrase,
        'topic_views' => rand(0, 99999),
        'topic_approved' => 1,
        'topic_time' => rand(1451606400, time()), // random time between 01/01/2016 12am and now
    ];
});

$factory->define(App\Models\Forum\Post::class, function (Faker\Generator $faker) {
  $u = User::orderByRaw('RAND()')->first();

    return  [
        'poster_id' => $u->user_id,
        'post_username' => $u->username,
        'post_subject' => $faker->catchPhrase,
        'post_text' => $faker->realtext(300),
        'post_time' => rand(1451606400, time()), // random time between 01/01/2016 12am and now
        'post_approved' => 1,
    ];
});
