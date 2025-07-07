<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => '',
        'large' => '',
    ],

    'index' => [
        'nav_title' => 'тізім',
    ],

    'judge' => [
        'comments' => '',
        'hide_judged' => '',
        'nav_title' => 'төреші',
        'no_current_vote' => '',
        'update' => 'жаңарту',
        'validation' => [
            'missing_score' => 'ұпай жоқ',
            'contest_vote_judged' => '',
        ],
        'voted' => '',
    ],

    'judge_results' => [
        '_' => '',
        'creator' => '',
        'score' => 'Ұпай',
        'score_std' => '',
        'total_score' => '',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => '',
        'judged_notice' => '',
        'login_required' => 'Дауыс беру үшін аккаунтыңызға кіріңіз.',
        'over' => '',
        'show_voted_only' => '',

        'best_of' => [
            'none_played' => "",
        ],

        'button' => [
            'add' => 'Дауыс беру',
            'remove' => 'Дауыс бермеу',
            'used_up' => 'Сіздің барлық даусыңыз қолданылған',
        ],

        'progress' => [
            '_' => ':used / :max дауыс берілген',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => '',
            ],
        ],
    ],

    'entry' => [
        '_' => 'өтінім',
        'login_required' => 'Жарыста қатысу үшін аккаунтыңызға кіріңіз.',
        'silenced_or_restricted' => '',
        'preparation' => 'Осы жарыс дайындық үстінде. Күтуіңізді сұраймыз!',
        'drop_here' => 'Өтініміңізді осы жерге тастаңыз',
        'download' => '.osz жүктеу',

        'wrong_type' => [
            'art' => 'Осы жарысқа тек .jpg және .png файлдары қабылданады.',
            'beatmap' => 'Осы жарысқа тек .osu файлдары қабылданады.',
            'music' => 'Осы жарысқа тек .mp3 файлдары қабылданады.',
        ],

        'wrong_dimensions' => 'Файлдың өлшемдері :widthx:height болуы керек',
        'too_big' => 'Файлдардың саны :limit-дейін болуы керек.',
    ],

    'beatmaps' => [
        'download' => 'Өтінімді Жүктеу',
    ],

    'vote' => [
        'list' => 'дауыс',
        'count' => ':count_delimited дауыс|:count_delimited дауыс',
        'points' => ':count_delimited ұпай|:count_delimited ұпай',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'Аяқталған уақыты :date',
        'ended_no_date' => 'Аяқталған уақыты',

        'starts' => [
            '_' => 'Басталу уақыты :date',
            'soon' => '',
        ],
    ],

    'states' => [
        'entry' => 'Өтінімдерді қабылдау ашық',
        'voting' => 'Дауыс беру басталды',
        'results' => 'Нәтиже шықты',
    ],
];
