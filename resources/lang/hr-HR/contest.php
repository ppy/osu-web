<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Natječi se na više načina od klikanja krugova.',
        'large' => 'Natjecanja zajednice',
    ],

    'index' => [
        'nav_title' => 'popis',
    ],

    'judge' => [
        'comments' => '',
        'hide_judged' => '',
        'nav_title' => '',
        'no_current_vote' => '',
        'update' => 'azuriraj',
        'validation' => [
            'missing_score' => '',
            'contest_vote_judged' => '',
        ],
        'voted' => '',
    ],

    'judge_results' => [
        '_' => '',
        'creator' => '',
        'score' => '',
        'score_std' => '',
        'total_score' => '',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => '',
        'judged_notice' => '',
        'login_required' => 'Molimo, prijavi se za glasanje.',
        'over' => 'Glasanje za ovo natjecanje je završeno',
        'show_voted_only' => 'Prikaži glasano',

        'best_of' => [
            'none_played' => "Čini se da nisi igrao/la nijednu beatmapu koja se kvalificira za ovo natjecanje!",
        ],

        'button' => [
            'add' => 'Glasaj',
            'remove' => 'Ukloni glas',
            'used_up' => 'Potrošio/la si sve svoje glasove',
        ],

        'progress' => [
            '_' => ':used / :max glasova iskorišteno',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => '',
            ],
        ],
    ],

    'entry' => [
        '_' => 'prijava',
        'login_required' => 'Prijavi se za sudjelovanje u natjecanju.',
        'silenced_or_restricted' => 'Ne možeš sudjelovati u natjecanjima dok si ograničen ili utišan/a.',
        'preparation' => 'Trenutno pripremamo ovaj natječaj. Molimo te da strpljivo pričekaš!',
        'drop_here' => 'Ispusti svou prijavu ovdje',
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'Preuzmi .osz',
        'wrong_file_type' => '',
        'wrong_dimensions' => '',
        'too_big' => 'Prijave za ovo natjecanje mogu biti samo do :limit.',
    ],

    'beatmaps' => [
        'download' => 'Preuzmi prijavu',
    ],

    'vote' => [
        'list' => 'glasovi',
        'count' => ':count_delimited glas|:count_delimited glasova',
        'points' => ':count_delimited poen|:count_delimited poena',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'Završilo :date',
        'ended_no_date' => 'Završeno',

        'starts' => [
            '_' => 'Počinje :date',
            'soon' => 'uskoro™',
        ],
    ],

    'states' => [
        'entry' => 'Prijave otvorene',
        'voting' => 'Glasanje započelo',
        'results' => 'Rezultati izašli',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
