<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Състезавайте се по повече начини освен да кликвате върху кръгчета.',
        'large' => 'Обществени конкурси',
    ],

    'index' => [
        'nav_title' => 'конкурси',
    ],

    'voting' => [
        'login_required' => 'Моля, влез в профила си, за да гласувате.',
        'over' => 'Гласуването за този конкурс е приключилo',
        'show_voted_only' => 'Моите гласове',

        'best_of' => [
            'none_played' => "Изглежда не сте играли никои от бийтмаповете, които са определени за този конкурс!",
        ],

        'button' => [
            'add' => 'Гласувай',
            'remove' => 'Премахване на гласа',
            'used_up' => 'Използвахте всичките си гласове',
        ],

        'progress' => [
            '_' => ':used / :max използвани гласа',
        ],
    ],
    'entry' => [
        '_' => 'запис',
        'login_required' => 'Моля, влез в профила си, за записване в конкурса.',
        'silenced_or_restricted' => 'Не може да се запишете в конкурс, докато сте ограничени или заглушени.',
        'preparation' => 'В момента подготвяме този конкурс. Моля, бъдете търпеливи!',
        'drop_here' => 'Пуснете вашия файл тук',
        'download' => 'Изтегляне на .osz',
        'wrong_type' => [
            'art' => 'Само файлове с .jpg или .png формат се приемат за този конкурс.',
            'beatmap' => 'Само файл с .osu формат се приема за този конкурс.',
            'music' => 'Само файл с .mp3 формат се приема за този конкурс.',
        ],
        'too_big' => 'Записите за този конкурс могат да са до :limit пъти.',
    ],
    'beatmaps' => [
        'download' => 'Изтегляне на запис',
    ],
    'vote' => [
        'list' => 'гласове',
        'count' => ':count_delimited глас|:count_delimited гласa',
        'points' => ':count_delimited точка|:count_delimited точки',
    ],
    'dates' => [
        'ended' => 'Приключи на :date',
        'ended_no_date' => 'Приключи',

        'starts' => [
            '_' => 'Започва на :date',
            'soon' => 'скоро™',
        ],
    ],
    'states' => [
        'entry' => 'Отворено записване',
        'voting' => 'Гласуването започна',
        'results' => 'Резултатите са обявени',
    ],
];
