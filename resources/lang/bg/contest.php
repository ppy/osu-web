<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Състезавайте се по още начини освен кликане върху кръгове.',
        'large' => 'Обществени конкурси',
    ],

    'index' => [
        'nav_title' => 'конкурси',
    ],

    'judge' => [
        'comments' => 'коментари',
        'hide_judged' => 'скрий гласуваните',
        'nav_title' => 'жури',
        'no_current_vote' => 'не сте гласували все още.',
        'update' => 'обнови',
        'validation' => [
            'missing_score' => 'липсващ резултат',
            'contest_vote_judged' => 'не може да гласувате ако сте жури',
        ],
        'voted' => 'Вече гласувахте за този запис.',
    ],

    'judge_results' => [
        '_' => 'Резултат от жури',
        'creator' => 'създател',
        'score' => 'Резултат',
        'score_std' => 'Стандартизиран резултат',
        'total_score' => 'общ резултат',
        'total_score_std' => 'общ стандартизиран резултат',
    ],

    'voting' => [
        'judge_link' => 'Вие сте жури в този конкурс. Оценете текущите записи!',
        'judged_notice' => 'Този конкурс използва системата жури, съдиите в момента обработват записите.',
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

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Трябва да изиграете всички бийтмапове от посочения плейлист преди да гласувате',
            ],
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

        'wrong_dimensions' => 'Записите за това състезание трябва да са :widthx:height',
        'too_big' => 'Записите за този конкурс могат да са до :limit пъти.',
    ],

    'beatmaps' => [
        'download' => 'Изтегляне на запис',
    ],

    'vote' => [
        'list' => 'гласове',
        'count' => ':count_delimited глас|:count_delimited гласa',
        'points' => ':count_delimited точка|:count_delimited точки',
        'points_float' => ':points точки',
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

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
