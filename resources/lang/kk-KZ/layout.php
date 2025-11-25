<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '',
    ],

    'defaults' => [
        'page_description' => '',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => 'сайыс',
            'root' => 'консоль',
        ],

        'artists' => [
            'index' => 'тізім',
        ],

        'beatmapsets' => [
            'show' => '',
            'discussions' => '',
            'versions' => '',
        ],

        'changelog' => [
            'index' => 'тізім',
        ],

        'help' => [
            'index' => '',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => '',
            'orders' => '',
            'products' => '',
        ],

        'tournaments' => [
            'index' => 'тізім',
        ],

        'users' => [
            'modding' => '',
            'playlists' => '',
            'quickplay' => '',
            'realtime' => '',
            'show' => '',
        ],
    ],

    'gallery' => [
        'close' => 'Жабу (Esc)',
        'fullscreen' => '',
        'zoom' => '',
        'previous' => '',
        'next' => '',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => '',
        ],
        'community' => [
            '_' => '',
            'dev' => '',
        ],
        'help' => [
            '_' => 'көмек',
            'getAbuse' => '',
            'getFaq' => 'faq',
            'getRules' => 'ережелер',
            'getSupport' => 'маған шыныңда көмек керек!',
        ],
        'home' => [
            '_' => 'басты бет',
            'team' => 'команда',
        ],
        'rankings' => [
            '_' => '',
        ],
        'store' => [
            '_' => 'дүкен',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '',
            'home' => 'Басты бет',
            'changelog-index' => '',
            'beatmaps' => 'Карталар тізімі',
            'download' => 'osu! жүктеу',
        ],
        'help' => [
            '_' => '',
            'faq' => '',
            'forum' => '',
            'livestreams' => 'Тікелей эфир',
            'report' => '',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => '',
            'copyright' => 'Авторлық құқық (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Құпиялық',
            'rules' => '',
            'server_status' => '',
            'source_code' => '',
            'terms' => '',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '',
            'description' => '',
        ],
        '404' => [
            'error' => '',
            'description' => "",
        ],
        '403' => [
            'error' => "",
            'description' => '',
        ],
        '401' => [
            'error' => "",
            'description' => '',
        ],
        '405' => [
            'error' => '',
            'description' => "",
        ],
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => '',
            'description' => "",
        ],
        'fatal' => [
            'error' => '',
            'description' => "",
        ],
        '503' => [
            'error' => '',
            'description' => "",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "",
    ],

    'popup_login' => [
        'button' => 'кіру / тіркелу',

        'login' => [
            'forgot' => "",
            'password' => '',
            'title' => 'Жалғастыру үшін аккаунтыңызға кіріңіз',
            'username' => 'пайдаланушы аты',

            'error' => [
                'email' => "",
                'password' => '',
            ],
        ],

        'register' => [
            'download' => 'Жүктеу',
            'info' => '',
            'title' => "",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Параметрлер',
            'follows' => '',
            'friends' => '',
            'legacy_score_only_toggle' => '',
            'legacy_score_only_toggle_tooltip' => '',
            'logout' => 'Шығу',
            'profile' => '',
            'scoring_mode_toggle' => '',
            'scoring_mode_toggle_tooltip' => '',
            'team' => '',
        ],
    ],

    'popup_search' => [
        'initial' => '',
        'retry' => '',
    ],
];
