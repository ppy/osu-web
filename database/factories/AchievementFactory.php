<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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

$factory->define(App\Models\Achievement::class, function (Faker\Generator $faker) {
    $achievementSlugs = ['all-packs-anime-1', 'all-packs-anime-2', 'all-packs-gamer-1', 'all-packs-gamer-2', 'all-packs-rhythm-1', 'all-packs-rhythm-2', 'osu-combo-500', 'osu-combo-750', 'osu-combo-1000', 'osu-combo-2000'];
    $groupings = ['Misc Achievements 1', 'Misc Achievements 2'];

    return [
        'achievement_id' => $faker->unique()->numberBetween(1, 5000),
        'name' => substr($faker->catchPhrase, 0, 40),
        'description' => $faker->realText(30),
        'quest_instructions' => $faker->realText(30),
        'image' => 'http://s.ppy.sh/images/achievements/gamer2.png',
        'grouping' => array_rand_val($groupings),
        'slug' => array_rand_val($achievementSlugs),
        'ordering' => 0,
        'progression' => 0,
    ];
});
