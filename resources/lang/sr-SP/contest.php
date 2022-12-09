<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Такмичите се на више начина уместо само кликтања кружића.',
        'large' => 'Такмичења заједнице',
    ],

    'index' => [
        'nav_title' => 'листинг',
    ],

    'voting' => [
        'login_required' => 'Молимо Вас да се пријавите како би сте гласали.',
        'over' => 'Гласање за ово такмичење се завршило',
        'show_voted_only' => 'Покажите гласове',

        'best_of' => [
            'none_played' => "Не изгледа као да сте играли мапе које се квалификују за ово такмичење!",
        ],

        'button' => [
            'add' => 'Гласајте',
            'remove' => 'Уклониte глас',
            'used_up' => 'Искористили сте све Ваше гласове',
        ],

        'progress' => [
            '_' => ':used/ :max гласове искоришћено',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Морате одиграти све мапе у плејлисти пре гласања',
            ],
        ],
    ],
    'entry' => [
        '_' => 'пријава',
        'login_required' => 'Молимо Вас да се пријавите да би сте гласали.',
        'silenced_or_restricted' => 'Не можете се пријавити за такмичења док сте рестриктовани или мутирани.',
        'preparation' => 'Тренутно припремамо ово такмичење. Молимо Вас да будете стрпљиви!',
        'drop_here' => 'Превуците овде вашу пријаву',
        'download' => 'Преузмите .osz',
        'wrong_type' => [
            'art' => 'Само .jpg и .png су дозвољени за ово такмичење.',
            'beatmap' => 'Само .osu фајлови су дозвољени за ово такмичење.',
            'music' => 'Само .mp3 фајлови су дозвољени за ово такмичење.',
        ],
        'wrong_dimensions' => 'Пријаве за ово такмичење морају бити :widthx:height',
        'too_big' => 'Број пријава за ово такмичење може бити до :limit.',
    ],
    'beatmaps' => [
        'download' => 'Преузмите пријаву',
    ],
    'vote' => [
        'list' => 'гласови',
        'count' => ':count_delimited глас|:count_delimited гласова',
        'points' => ':count_delimited поен|:count_delimited поени',
    ],
    'dates' => [
        'ended' => 'Завршено :date',
        'ended_no_date' => 'Завршено',

        'starts' => [
            '_' => 'Почиње :date',
            'soon' => 'ускоро™',
        ],
    ],
    'states' => [
        'entry' => 'Пријаве су отворене',
        'voting' => 'Гласање је почело',
        'results' => 'Резултати су изашли',
    ],
];
