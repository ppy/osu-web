<?php

$factory->define(App\Models\UserDonation::class, function (Faker\Generator $faker) {
    return  [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->user_id;
        },
        'target_user_id' => function (array $self) {
            return $self['user_id'];
        },
        'transaction_id' => 'faked-'.time()."-{$faker->randomNumber()}",
        'length' => 1,
        'amount' => 4,
        'cancel' => false,
    ];
});

$factory->state(App\Models\UserDonation::class, 'cancelled', function (Faker\Generator $faker) {
    return  [
        'transaction_id' => 'faked-'.time()."-{$faker->randomNumber()}-cancel",
        'cancel' => true,
    ];
});
