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
            'contests' => '',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            'index' => '',
        ],

        'changelog' => [
            'index' => '',
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
            'index' => '',
        ],

        'users' => [
            'modding' => '',
            'multiplayer' => '',
            'show' => '',
        ],
    ],

    'gallery' => [
        'close' => '',
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
            '_' => '',
            'getAbuse' => '',
            'getFaq' => '',
            'getRules' => '',
            'getSupport' => '',
        ],
        'home' => [
            '_' => '',
            'team' => '',
        ],
        'rankings' => [
            '_' => '',
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
