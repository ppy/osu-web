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

use App\Models\BeatmapDiscussion;
use App\Models\Beatmapset;

$factory->define(Beatmapset::class, function (Faker\Generator $faker) {
    $artist = $faker->name;
    $title = $faker->sentence(rand(0, 5));
    $isApproved = (int) (rand(0, 2) > 0);

    return [
        'creator' => $faker->userName,
        'artist' => $artist,
        'title' => $title,
        'discussion_enabled' => true,
        'displaytitle' => "{$artist}|{$title}",
        'source' => $faker->domainWord,
        'tags' => $faker->domainWord,
        'bpm' => rand(100, 200),
        'approved' => $isApproved,
        'approved_date' => $isApproved ? Carbon\Carbon::now() : null,
        'play_count' => rand(0, 50000),
        'favourite_count' => rand(0, 500),
        'genre_id' => function () {
            return factory(App\Models\Genre::class)->create()->genre_id;
        },
        'language_id' => function () {
            return factory(App\Models\Language::class)->create()->language_id;
        },
        'submit_date' => $faker->dateTime(),
        'thread_id' => 0,
        'offset' => 0,
    ];
});

$factory->state(Beatmapset::class, 'deleted', function () {
    return ['deleted_at' => now()];
});

$factory->state(Beatmapset::class, 'inactive', function () {
    return ['active' => 0];
});

$factory->state(Beatmapset::class, 'no_discussion', function () {
    return ['discussion_enabled' => false];
});

$factory->state(Beatmapset::class, 'qualified', function () {
    $approvedAt = now();

    return [
        'approved' => Beatmapset::STATES['qualified'],
        'approved_date' => $approvedAt,
        'queued_at' => $approvedAt,
    ];
});

$factory->afterCreatingState(Beatmapset::class, 'with_discussion', function (App\Models\Beatmapset $beatmapset) {
    if (
        !$beatmapset->beatmaps()->save(
            factory(App\Models\Beatmap::class)->make()
        )
    ) {
        throw new Exception();
    }

    if (
        !$beatmapset->beatmapDiscussions()->save(
            factory(BeatmapDiscussion::class)->states('general')->make(['user_id' => $beatmapset->user_id])
        )
    ) {
        throw new Exception();
    }
});
