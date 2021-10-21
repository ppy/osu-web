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
            'contest' => 'konkursas',
            'contests' => 'konkursai',
            'root' => 'konsolė',
        ],

        'artists' => [
            'index' => 'sąrašas',
        ],

        'changelog' => [
            'index' => 'sąrašas',
        ],

        'help' => [
            'index' => 'indeksas',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => 'krepšelis',
            'orders' => 'užsakymų istorija',
            'products' => 'prekės',
        ],

        'tournaments' => [
            'index' => 'sąrašas',
        ],

        'users' => [
            'modding' => '',
            'multiplayer' => '',
            'show' => 'informacija',
        ],
    ],

    'gallery' => [
        'close' => 'Užverti (Esc)',
        'fullscreen' => 'Perjungti viso ekrano būsena',
        'zoom' => '',
        'previous' => '',
        'next' => '',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmapai',
        ],
        'community' => [
            '_' => 'bendruomenė',
            'dev' => '',
        ],
        'help' => [
            '_' => 'pagalba',
            'getAbuse' => 'pranešti apie piktnaudžiavimą',
            'getFaq' => '',
            'getRules' => 'taisyklės',
            'getSupport' => 'ne, tikrai, man reikia pagalbos!',
        ],
        'home' => [
            '_' => 'pagrindinis',
            'team' => 'komanda',
        ],
        'rankings' => [
            '_' => 'reitingai',
            'kudosu' => '',
        ],
        'store' => [
            '_' => '',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => '',
            'home' => '',
            'changelog-index' => '',
            'beatmaps' => '',
            'download' => '',
        ],
        'help' => [
            '_' => '',
            'faq' => '',
            'forum' => '',
            'livestreams' => '',
            'report' => '',
            'wiki' => '',
        ],
        'legal' => [
            '_' => '',
            'copyright' => '',
            'privacy' => '',
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
        'button' => '',

        'login' => [
            'forgot' => "",
            'password' => '',
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
            'account-edit' => '',
            'follows' => '',
            'friends' => '',
            'logout' => '',
            'profile' => '',
        ],
    ],

    'popup_search' => [
        'initial' => '',
        'retry' => '',
    ],
];
