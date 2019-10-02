<?php

$factory->define(App\Models\OAuth\Client::class, function (Faker\Generator $faker) {
    return  [
        'user_id' => function () {
            return factory(App\Models\User::class)->create(['user_sig' => ''])->getKey();
        },
        'name' => function () use ($faker) {
            return $faker->realText(20);
        },
        'secret' => str_random(40),
        'redirect' => 'https://localhost/callback',
        'personal_access_client' => false,
        'password_client' => false,
        'revoked' => false,
    ];
});
