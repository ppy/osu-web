<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Makilahok sa mas maraming paraan kaysa sa pagpindot lamang ng mga bilog.',
        'large' => 'Paligsahang Pangkomunidad',
    ],

    'index' => [
        'nav_title' => 'listahan',
    ],

    'judge' => [
        'comments' => '',
        'hide_judged' => 'itago ang hinuhusgahang mga entry',
        'nav_title' => 'maghusga',
        'no_current_vote' => 'hindi ka pa nakaboto.',
        'update' => 'i-update',
        'validation' => [
            'missing_score' => 'nawawalang iskor',
            'contest_vote_judged' => 'hindi maaaring bumoto sa hinuhusgahang mga paligsahan',
        ],
        'voted' => 'Ikaw ay nakapagpasa na ng boto sa kalahok na ito.',
    ],

    'judge_results' => [
        '_' => 'Mga resulta sa paghuhusga',
        'creator' => 'tagagawa',
        'score' => 'Puntos',
        'score_std' => '',
        'total_score' => 'kabuuang puntos',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'Ikaw ay isang tagahatol ng paligsahang ito. Hatulan ang mga kalahok dito!',
        'judged_notice' => 'Ang patimpalak na ito ay gumagamit ng sistema ng paghusga, ang mga hukom ay kasalukuyang nagpoproseso ng mga entry.',
        'login_required' => 'Paki-sign-in upang bumoto.',
        'over' => 'Ang pagboboto sa paligsahan na ito ay tapos na',
        'show_voted_only' => 'Ipakita ang mga binoto',

        'best_of' => [
            'none_played' => "Mukhang hindi ka nakapaglaro ng mga beatmap na kwalipikado sa paligsahan na ito!",
        ],

        'button' => [
            'add' => 'Bumoto',
            'remove' => 'Tanggalin ang Boto',
            'used_up' => 'Nagamit na lahat ng boto mo',
        ],

        'progress' => [
            '_' => ':used sa :max na boto ang gamit na',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Dapat laruin ang lahat ng mga beatmap sa tinukoy na mga playlist bago bumoto',
            ],
        ],
    ],

    'entry' => [
        '_' => 'entrada',
        'login_required' => 'Paki-sign-in upang makapasok sa paligsahan.',
        'silenced_or_restricted' => 'Hindi ka pwedeng sumali sa mga paligsahan habang naka-restricted o naka-silenced ka.',
        'preparation' => 'Hinahanda pa namin ang pagligsahang ito. Mangyaring maghintay nang matiyaga!',
        'drop_here' => 'Ihulog ang iyong entrada dito',
        'download' => 'I-download ang .osz',

        'wrong_type' => [
            'art' => 'Ang mga .jpg at .png na file lamang ang tinatanggap para sa paligsahang ito.',
            'beatmap' => 'Ang mga .osu file lamang ang tinatanggap para sa paligsahang ito.',
            'music' => 'Ang mga .mp3 file lamang ang tinatanggap para sa paligsahang ito.',
        ],

        'wrong_dimensions' => 'Ang mga entry para sa patimpalak na ito ay dapat na :widthx:height',
        'too_big' => 'Ang bilang ng pagsumite sa paligsahan na ito ay hanggang :limit.',
    ],

    'beatmaps' => [
        'download' => 'I-download Ang Entrada',
    ],

    'vote' => [
        'list' => 'mga boto',
        'count' => ':count_delimited boto|:count_delimited mga boto',
        'points' => ':count_delimited puntos|:count_delimited mga puntos',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'Natapos sa :date',
        'ended_no_date' => 'Pagwawakas',

        'starts' => [
            '_' => 'Magsisimula sa :date',
            'soon' => 'malapit na™',
        ],
    ],

    'states' => [
        'entry' => 'Maaaring Magsumite',
        'voting' => 'Nagsimula ang Pagboto',
        'results' => 'Linabas Ang Mga Resulta',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
