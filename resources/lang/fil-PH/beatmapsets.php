<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Ang beatmap na ito ay hindi maaaring i-download sa kasalukuyan.',
        'parts-removed' => 'Tinanggal ang mga bahagi ng beatmap na ito sa kahilingan ng lumikha nito o ng isang ikatlong panig na mayhawak ng karapatan.',
        'more-info' => 'Tignan dito para sa karagdagang impormasyon.',
        'rule_violation' => 'Iilang bagay sa map na ito ang tinanggal pagkatapos ituring na hindi angkop para gamitin sa osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Hinay lang, maglaro ka muna.',
    ],

    'featured_artist_badge' => [
        'label' => 'Featured artist',
    ],

    'index' => [
        'title' => 'Listahan ng mga Beatmap',
        'guest_title' => 'Mga Beatmap',
    ],

    'panel' => [
        'empty' => 'walang beatmap',

        'download' => [
            'all' => 'mag-download',
            'video' => 'i-download nang may bidyo',
            'no_video' => 'i-download nang walang bidyo',
            'direct' => 'buksan sa osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Kailangan mong pumili ng kahit isang playmode na i-nonominate sa hybrid na mga beatmap.',
        'incorrect_mode' => 'Wala kang pahintulot na mag-nominate para sa mode :mode',
        'full_bn_required' => 'Kailangan mong maging full nominator para maisagawa ang qualifying nomination na ito.',
        'too_many' => 'Nabuo na ang pangangailangan sa nominasyon.',

        'dialog' => [
            'confirmation' => 'Sigurado ka bang gusto mong i-nomina ito?',
            'header' => 'Inomina ang Beatmap',
            'hybrid_warning' => 'tandaan: ikaw ay maaaring mag-nominate nang isang beses lamang, kaya siguraduhin na ikaw ay nagno-nominate para sa lahat ng game mode na iyong binabalak',
            'which_modes' => 'Inomina para sa aling mga mode?',
        ],
    ],

    'nsfw_badge' => [
        'label' => 'Maselan',
    ],

    'show' => [
        'discussion' => 'Diskusyon',

        'details' => [
            'by_artist' => 'ni/nina :artist',
            'favourite' => 'I-paborito ang beatmapset na ito',
            'favourite_login' => 'Mag-sign in para i-favourite ang beatmap na ito',
            'logged-out' => 'Kailangan mong mag-sign-in bago ka pwedeng mag-download ng mga beatmap!',
            'mapped_by' => 'minapa ni :mapper',
            'unfavourite' => 'I-unfavorite ang beatmap na ito',
            'updated_timeago' => 'huling na-update sa :timeago',

            'download' => [
                '_' => 'I-download',
                'direct' => '',
                'no-video' => 'walang Video',
                'video' => 'may Video',
            ],

            'login_required' => [
                'bottom' => 'para mas maraming features ang magamit',
                'top' => 'Sign in',
            ],
        ],

        'details_date' => [
            'approved' => 'aprubado :timeago',
            'loved' => 'pasok sa loved :timeago',
            'qualified' => 'pasok sa qualified :timeago',
            'ranked' => 'pasok sa ranked :timeago',
            'submitted' => 'ini-upload :timeago',
            'updated' => 'huling na-update :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Napakarami mo nang nai-favorite na mga beatmap! Mag-unfavorite ng ilan bago subukang muli.',
        ],

        'hype' => [
            'action' => 'I-hype ang beatmap na ito kung nagustuhan mo ang paglalaro nito upang matulungan itong pumasok sa <strong>Ranked</strong>.',

            'current' => [
                '_' => 'Ang map na ito ay kasalukuyang :status.',

                'status' => [
                    'pending' => 'pending',
                    'qualified' => 'qualified',
                    'wip' => 'ginagawa pa lang',
                ],
            ],

            'disqualify' => [
                '_' => 'Kung ikaw ay may nakitang problema sa beatmap na ito, mangyaring i-disqualify ito :link.',
            ],

            'report' => [
                '_' => 'Kung ikaw ay may nakitang problema sa beatmpa na ito, mangyaring iulat ito :link para malaman namin.',
                'button' => 'Mag-report ng Problema',
                'link' => 'dito',
            ],
        ],

        'info' => [
            'description' => 'Deskripsyon',
            'genre' => 'Dyanre',
            'language' => 'Wika',
            'no_scores' => 'Kinakalkula pa ang mga datos...',
            'nsfw' => 'Maselang nilalaman',
            'points-of-failure' => 'Mga punto ng pagkabigo',
            'source' => 'Pinagmulan',
            'storyboard' => 'Ang beatmap na ito ay may storyboard',
            'success-rate' => 'Rate ng Pagkakapasa',
            'tags' => 'Mga Tag',
            'video' => 'Ang beatmap na ito ay may bidyo',
        ],

        'nsfw_warning' => [
            'details' => 'Ang beatmap na ito ay naglalaman ng mga bagay na hindi angkop sa lahat ng manonood. Nais mo bang magpatuloy?',
            'title' => 'Maselang Nilalaman',

            'buttons' => [
                'disable' => 'Tanggalin ang pagbabala',
                'listing' => 'Mga Beatmap',
                'show' => 'Ipakita',
            ],
        ],

        'scoreboard' => [
            'achieved' => 'nakamit nang :when',
            'country' => 'Ranggong Pambansa',
            'friend' => 'Ranggo sa Kaibigan',
            'global' => 'Pandaigdigang Ranggo',
            'supporter-link' => 'I-click <a href=":link">ito</a> para makita ang mga feature na iyong matatamasa!',
            'supporter-only' => 'Kailangan mong maging osu!supporter para mabuksan ang Ranggo sa Kaibigan at Pambansang Ranggo!',
            'title' => 'Talaan ng Iskor',

            'headers' => [
                'accuracy' => 'Katumpakan',
                'combo' => 'Pinakamahabang Combo',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'pin' => '',
                'player' => 'Manlalaro',
                'pp' => '',
                'rank' => 'Rank',
                'score' => 'Puntos',
                'score_total' => 'Kabuuang Puntos',
                'time' => 'Oras',
            ],

            'no_scores' => [
                'country' => 'Wala pa sa iyong bansa ang nakatala ng iskor sa mapang ito!',
                'friend' => 'Wala pa sa iyong mga kaibigan ang nakatala ng iskor sa mapang ito!',
                'global' => 'Wala pang mga iskor. Nais mo bang maglagay dito?',
                'loading' => 'Nilo-load ang mga iskor...',
                'unranked' => 'Hindi Ranked na beatmap.',
            ],
            'score' => [
                'first' => 'Nangunguna',
                'own' => 'Iyong Best',
            ],
        ],

        'stats' => [
            'cs' => 'Laki ng Bilog',
            'cs-mania' => 'Bilang ng Key',
            'drain' => 'Pagubos ng HP',
            'accuracy' => 'Katumpakan',
            'ar' => 'Approach Rate',
            'stars' => 'Star Difficulty',
            'total_length' => 'Haba',
            'bpm' => 'BPM',
            'count_circles' => 'Bilang ng Bilog',
            'count_sliders' => 'Bilang ng Slider',
            'user-rating' => 'Rating ng mga User',
            'rating-spread' => 'Pagkakalatag ng Rating',
            'nominations' => 'Mga Nominasyon',
            'playcount' => 'Bilang ng Paglaro',
        ],

        'status' => [
            'ranked' => 'Ranked',
            'approved' => 'Aprubado',
            'loved' => 'Loved',
            'qualified' => 'Kwalipikado',
            'wip' => 'Ginagawa pa lang',
            'pending' => 'Nakabinbin',
            'graveyard' => 'Abandunado',
        ],
    ],
];
