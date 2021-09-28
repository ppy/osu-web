<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritms ir tikai *klikšķa* attālumā! Ar Ouendan/EBA, Taiko un oriģināliem spēļu režīmiem, kā arī ar pilnveidotu, funkcionālu līmeņu rediģētāju.',
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
            'index' => 'indekss',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => '',
            'orders' => '',
            'products' => 'produkti',
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
        'close' => 'Aiztaisīt (Esc)',
        'fullscreen' => 'Lūkot pilnekrānā',
        'zoom' => 'Pietuvināt/Attālināt',
        'previous' => 'Iepriekšējais (bulta pa kreisi)',
        'next' => 'Nākamais (bulta pa labi)',
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
            '_' => 'sākums',
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
            'faq' => 'Biežāk Uzdotie Jautājumi',
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
            'password' => 'parole',
            'title' => 'Ielogojieties, lai turpinātu',
            'username' => '',

            'error' => [
                'email' => "Lietotājvārds vai e-pasta adrese neeksistē",
                'password' => 'Nepareiza parole',
            ],
        ],

        'register' => [
            'download' => 'Lejuplādēt',
            'info' => 'Lejupielādēt osu!, lai izveidotu savu kontu!',
            'title' => "Nav vēl konta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Iestatījumi',
            'follows' => '',
            'friends' => 'Draugi',
            'logout' => 'Iziet',
            'profile' => 'Mans Profils',
        ],
    ],

    'popup_search' => [
        'initial' => 'Rakstiet, lai meklētu!',
        'retry' => 'Meklēšana neizdevās. Spiediet, lai atkārtotu.',
    ],
];
