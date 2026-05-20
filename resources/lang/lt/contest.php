<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Rungtyniauk per daugiau būdų, nei tik apskritimų spaudinėjimą.',
        'large' => 'Bendruomenės Konkursai',
    ],

    'index' => [
        'nav_title' => 'sąrašas',
    ],

    'judge' => [
        'comments' => 'komentarai',
        'hide_judged' => 'slėpti vertintus pateikimus',
        'nav_title' => 'vertintojas',
        'no_current_vote' => 'dar nebalsavote.',
        'update' => 'atnaujinti',
        'validation' => [
            'missing_score' => 'nenurodyti taškai',
            'contest_vote_judged' => 'negalite balsuoti jau vertintuose konkursuose',
        ],
        'voted' => 'Jau balsavote šiame pateikime.',
    ],

    'judge_results' => [
        '_' => '
Vertinimo rezultatai',
        'creator' => 'kūrėjas',
        'score' => 'Rezultatas',
        'score_std' => 'Standartizuotas Rezultatas',
        'total_score' => 'bendras rezultatas',
        'total_score_std' => 'bendras standartizuotas rezultatas',
    ],

    'voting' => [
        'judge_link' => 'Jus esate vertintojas šiame konkurse. Vertinkite pateikimus čia!',
        'judged_notice' => 'Šis konkursas naudoja vertinimo sistemą, vertintojai tvarkosi su pateikimais.',
        'login_required' => 'Balsavimui reikia prisijungti.',
        'over' => 'Balsavimas šitam konkursui baigėsi',
        'show_voted_only' => 'Rodyti balsus',

        'best_of' => [
            'none_played' => "Nepanašu, kad žaidėte beatmap'ų, kurie butu kvalifikuoti šiam konkursui!",
        ],

        'button' => [
            'add' => 'Balsuoti',
            'remove' => 'Pašalinti balsą',
            'used_up' => 'Jūs jau išnaudojote visus turimus balsus',
        ],

        'progress' => [
            '_' => ':used / :max balsų panaudota',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Privaloma sužaisti visus beatmap\'us nurodytuose grojaraščiuose prieš balsuojant',
            ],
        ],
    ],

    'entry' => [
        '_' => 'pateiktis',
        'login_required' => 'Prašome prisijungti norint įeiti į šį konkursą.',
        'silenced_or_restricted' => 'Jūs negalite dalyvauti konkursuose būdami uždrausti arba nutildyti.',
        'preparation' => 'Dabar mes ruošiam šį konkursą. Prašome kantriai palaukti!',
        'drop_here' => 'Numesk savo pateikti čia',
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'Atsiųsti .osz',
        'wrong_file_type' => '',
        'wrong_dimensions' => 'Pateikymai šiam konkursui turi būti :widthx:height',
        'too_big' => 'Pateikymai šiam konkursui gali būti tik iki :limit.',
    ],

    'beatmaps' => [
        'download' => 'Atsisiųsti Pateiktį',
    ],

    'vote' => [
        'list' => 'balsai',
        'count' => ':count_delimited balsas|:count_delimited balsų',
        'points' => ':count_delimited taškas|:count_delimited taškų',
        'points_float' => ':points taškai',
    ],

    'dates' => [
        'ended' => 'Baigėsi :date',
        'ended_no_date' => 'Baigėsi',

        'starts' => [
            '_' => 'Pradžia :date',
            'soon' => 'greitai™',
        ],
    ],

    'states' => [
        'entry' => 'Atidarytas Pateikimui',
        'voting' => 'Balsavimas Pradėtas',
        'results' => 'Yra rezultatai',
    ],

    'show' => [
        'admin' => [
            'page' => 'Peržiūrėti informaciją ir pateikimus',
        ],
    ],
];
