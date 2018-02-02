<?php

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    $existing_users = DB::table('phpbb_users')->get();
    $countries = DB::table('osu_countries')->get()->toArray();

    $existing_names = [];
    $existing_ids = [];

    foreach ($existing_users as $existing_usr) {
        $existing_ids[] = $existing_usr->user_id;
        $existing_names[] = $existing_usr->username;
    }

    $username = null;
    $userid = null;

    // Check username doesn't already exist
    while ($username === null) {
        if (!in_array($uname = $faker->userName, $existing_names, true)) {
            $username = substr(str_replace('.', ' ', $uname), 0, 15); // remove fullstops from username
        }
    }

    // Generate a random unique ID
    $userid = null;
    while ($userid === null) {
        if (!in_array($uid = rand(1, 600000), $existing_ids, true)) {
            $userid = $uid;
        }
    }

    // Get a random country
    if (count($countries) > 0) {
        $country = array_rand_val($countries);
        if ($country->acronym) {
            $country_ac = $country->acronym;
        }
    } else {
        $country_ac = '';
    }

    return [
        'username' => $username,
        'user_id' => $userid,
        'user_password' => password_hash(md5('password'), PASSWORD_BCRYPT),
        'user_email' => $faker->safeEmail,
        'user_lastvisit' => rand(1451606400, time()), // random timestamp between 01/01/2016 and now
        'user_posts' => rand(1, 500),
        'user_warnings' => 0,
        'user_type' => 0,
        'osu_kudosavailable' => rand(1, 500),
        'osu_kudosdenied' => rand(1, 500),
        'osu_kudostotal' => rand(1, 500),
        'country_acronym' => $country_ac,
        'osu_playstyle' => [array_rand(App\Models\User::PLAYSTYLES)],
        'user_website' => 'http://www.google.com/',
        'user_twitter' => 'ppy',
        'user_permissions' => '',
        'user_interests' => substr($faker->bs, 30),
        'user_occ' => substr($faker->catchPhrase, 30),
        'user_sig' => function () use ($faker) {
            // avoids running if user_sig is supplied.
            return $faker->realText(155);
        },
        'user_from' => substr($faker->country, 30),
        'user_regdate' => $faker->dateTimeBetween('-6 years', 'now'),
    ];
});
