<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

use App\Models\Forum\AuthOption;
use App\Models\Forum\Authorize;
use App\Models\Forum\Forum;
use App\Models\Forum\PollOption;
use App\Models\Forum\Post;
use App\Models\Forum\Topic;
use App\Models\User;

$factory->define(App\Models\Forum\Forum::class, fn () => []);

$factory->state(App\Models\Forum\Forum::class, 'parent', function (Faker\Generator $faker) {
    return [
        'forum_name' => $faker->catchPhrase,
        'forum_desc' => $faker->realtext(80),
        'forum_type' => 0,
        'forum_parents' => [],
        'forum_rules' => '',
    ];
});

$factory->state(App\Models\Forum\Forum::class, 'child', function (Faker\Generator $faker) {
    return [
        'forum_name' => $faker->catchPhrase,
        'forum_desc' => $faker->realtext(80),
        'forum_type' => 1,
        'forum_parents' => [],
        'forum_rules' => '',
    ];
});

$factory->define(App\Models\Forum\Topic::class, function (Faker\Generator $faker) {
    return [
        'forum_id' => factory(Forum::class)->state('parent'),
        'topic_title' => $faker->catchPhrase,
        'topic_views' => rand(0, 99999),
        'topic_approved' => 1,
        'topic_time' => Carbon\Carbon::createFromTimestamp(rand(1451606400, time())), // random time between 01/01/2016 12am and now
    ];
});

$factory->afterCreatingState(Topic::class, 'with_first_post', function (Topic $topic) {
    $postAttributes = ['forum_id' => $topic->forum_id];

    if ($topic->topic_poster !== null) {
        $postAttributes['poster_id'] = $topic->topic_poster;
    }

    $topic->posts()->save(factory(Post::class)->make($postAttributes));
    $topic->refreshCache();
});

$factory->state(Topic::class, 'poll', function (Faker\Generator $faker) {
    return [
        'poll_hide_results' => $faker->boolean,
        'poll_length' => $faker->boolean ? $faker->numberBetween(86400, 604800) : 0, // between 1 and 7 days, or infinite length
        'poll_title' => $faker->sentence,
        'poll_vote_change' => $faker->boolean,
    ];
});

$factory->afterCreatingState(Topic::class, 'poll', function (Topic $topic, Faker\Generator $faker) {
    $optionCount = $faker->numberBetween(2, 10);
    $options = [];

    for ($id = 0; $id < $optionCount; $id++) {
        $options[] = PollOption::factory()->make(['poll_option_id' => $id]);
    }

    $topic->pollOptions()->saveMany($options);
    $topic->update([
        'poll_max_options' => $faker->numberBetween(1, $optionCount),
        'poll_start' => $topic->topic_time,
    ]);
});

$factory->define(App\Models\Forum\Post::class, function (Faker\Generator $faker) {
    return [
        'poster_id' => function (array &$self) {
            $factoryUser = User::factory()->create();
            $self['post_username'] = $factoryUser->username;

            return $factoryUser->getKey();
        },
        'post_subject' => $faker->catchPhrase,
        'post_text' => $faker->realtext(300),
        'post_time' => Carbon\Carbon::createFromTimestamp(rand(1451606400, time())), // random time between 01/01/2016 12am and now
        'post_approved' => 1,
    ];
});

$factory->define(AuthOption::class, fn () => []);

$factory->state(AuthOption::class, 'post', ['auth_option' => 'f_post']);

$factory->state(AuthOption::class, 'reply', ['auth_option' => 'f_reply']);

$factory->define(Authorize::class, fn () => []);

$factory->state(Authorize::class, 'post', function (Faker\Generator $faker) {
    return [
        'auth_option_id' => function () {
            return AuthOption::where('auth_option', 'f_post')->first() ?? factory(AuthOption::class)->states('post');
        },
        'auth_setting' => 1,
    ];
});

$factory->state(Authorize::class, 'reply', function (Faker\Generator $faker) {
    return [
        'auth_option_id' => function () {
            return AuthOption::where('auth_option', 'f_reply')->first() ?? factory(AuthOption::class)->states('reply');
        },
        'auth_setting' => 1,
    ];
});
