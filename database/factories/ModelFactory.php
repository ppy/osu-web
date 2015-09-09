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

/** Each factory is for a different table in the DB.
    There can be variables set specifcally for each table.
    Global variables for multiple tables are set in DatabaseSeeder.php. **/



$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'user_password' => password_hash(md5("password"), PASSWORD_BCRYPT),
        'user_email' => $faker->email,
    ];
});

$factory->define(App\Models\BeatmapSet::class, function (Faker\Generator $faker) {

    $artist = $faker->domainWord;
    $title = $faker->realText($maxNbChars = 20, $indexSize = 5);
    $displaytitle = ucfirst($artist) . " - " . str_replace(".", "", $title);

    return [
        'thread_id' => $faker->numberBetween($min = 1, $max = 9999),
        'artist' => $artist,
        'title' => $title,
        'tags' => $faker->userName.",".$faker->word.",".$faker->cityPrefix.",".$faker->streetName.",".$faker->userName.",".$faker->word.",".$faker->domainWord,
        'storyboard' => $faker->numberBetween($min = 0, $max = 1),
        'epilepsy' => $faker->numberBetween($min = 0, $max = 1),
        'bpm' => $faker->numberBetween($min = 170, $max = 240),
        'approved' => rand(-2,3),
        'filename' => $faker->domainWord,
        'rating' => $faker->numberBetween($min = 1, $max = 9),
        'displaytitle' => $displaytitle,
        'genre_id' => $faker->numberBetween($min = 0, $max = 6),
        'language_id' => $faker->numberBetween($min = 0, $max = 6),
        'star_priority' => $faker->numberBetween($min = 0, $max = 6),
        'filesize' => $faker->numberBetween($min = 1000, $max = 999999),
        'favourite_count' => $faker->numberBetween($min = 1, $max = 5000),
        'play_count' => $faker->numberBetween($min = 500, $max = 999999),
        'difficulty_names' => ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord) . ", " . ucfirst($faker->domainWord),
    ];
});

$factory->define(App\Models\Beatmap::class, function (Faker\Generator $faker) {

    $totallength = $faker->numberBetween($min = 60, $max = 600);
    $hitlength = $totallength - $faker->numberBetween($min = 10, $max = 60);
    $countnormal = $faker->numberBetween($min = 30, $max = 1337);
    $countslider = $faker->numberBetween($min = 30, $max = 1337);
    $countspinner = $faker->numberBetween($min = 0, $max = 0);
    $counttotal = $countnormal + $countslider + $countspinner;
    $playcount = $faker->numberBetween($min = 100, $max = 25000);
    $passcount = $playcount * $faker->randomFloat($nbMaxDecimals = 2, $min = 0.1, $max = 0.9);

    return [
        'filename' => $faker->numberBetween($min = 1, $max = 50000),
        'checksum' => $faker->md5,
        'version' => $faker->domainWord,
        'total_length' => $totallength,
        'hit_length' => $hitlength,
        'countTotal' => $counttotal,
        'countNormal' => $countnormal,
        'countSlider' => $countslider,
        'countSpinner' => $countspinner,
        'diff_drain' => $faker->numberBetween($min = 1, $max = 10),
        'diff_size' => $faker->numberBetween($min = 1, $max = 10),
        'diff_overall' => $faker->numberBetween($min = 1, $max = 10),
        'diff_approach' => $faker->numberBetween($min = 1, $max = 10),
        'playmode' => $faker->numberBetween($min = 0, $max = 3),
        'approved' => rand(-2,3),
        'difficultyrating' => $counttotal = $faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 9),
        'playcount' => $playcount,
        'passcount' => $passcount
    ];
});
