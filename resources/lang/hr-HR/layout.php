<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Automatski reprodukciraj sljedeću pjesmu',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritam je udaljen samo jedan *klik*! Sa Ouendan/EBA, Taiko i orginalnim modovima igre i  potpuno funkcionalnim level editorom. ',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'set beatmapa',
            'beatmapset_covers' => 'naslovne slike setova beatmapova',
            'contest' => 'natjecanje',
            'contests' => 'natjecanja',
            'root' => 'konzola',
        ],

        'artists' => [
            'index' => 'popis',
        ],

        'beatmapsets' => [
            'show' => 'informacije

',
            'discussions' => 'rasprava',
        ],

        'changelog' => [
            'index' => 'popis',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Mapa stranice',
        ],

        'store' => [
            'cart' => 'košarica',
            'orders' => 'povijest narudžbi',
            'products' => 'proizvodi',
        ],

        'tournaments' => [
            'index' => 'popis',
        ],

        'users' => [
            'modding' => 'modificiranje',
            'playlists' => 'popisi za reprodukciju',
            'realtime' => 'multiplayer',
            'show' => 'informacije

',
        ],
    ],

    'gallery' => [
        'close' => 'Zatvori (Esc)',
        'fullscreen' => 'Uključi/isključi cjeloekranski prikaz',
        'zoom' => 'Povećaj/smanji prikaz',
        'previous' => 'Prethodno (strelica lijevo)',
        'next' => 'Sljedeće (strelica desno)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmape',
        ],
        'community' => [
            '_' => 'zajednica',
            'dev' => 'razvoj',
        ],
        'help' => [
            '_' => 'pomoć',
            'getAbuse' => 'prijavi zloupotrebu',
            'getFaq' => 'faq',
            'getRules' => 'pravila',
            'getSupport' => 'ne, stvarno, treba mi pomoć!',
        ],
        'home' => [
            '_' => 'početna',
            'team' => 'ekipa',
        ],
        'rankings' => [
            '_' => 'ljestvice',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'trgovina',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Općenito',
            'home' => 'Početna',
            'changelog-index' => 'Popis promjena',
            'beatmaps' => 'Popis beatmapa',
            'download' => 'Preuzmi osu!',
        ],
        'help' => [
            '_' => 'Pomoć i Zajednica',
            'faq' => 'Često postavljana pitanja',
            'forum' => 'Forum Zajednice',
            'livestreams' => 'Strujanja Uživo',
            'report' => 'Prijavi Problem',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legalno i Status',
            'copyright' => 'Autorska prava (DMCA)',
            'privacy' => 'Privatnost',
            'server_status' => 'Status Servera',
            'source_code' => 'Izvorni kȏd',
            'terms' => 'Uvjeti',
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
        'button' => '',

        'login' => [
            'forgot' => "",
            'password' => 'lozinka',
            'title' => '',
            'username' => '',

            'error' => [
                'email' => "",
                'password' => '',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => '',
            'title' => "",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Postavke',
            'follows' => '',
            'friends' => 'Prijatelji',
            'logout' => '',
            'profile' => '',
        ],
    ],

    'popup_search' => [
        'initial' => '',
        'retry' => '',
    ],
];
