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
        ],

        'artists' => [
            'index' => '',
        ],

        'beatmapsets' => [
            'show' => '',
            'discussions' => '',
        ],

        'changelog' => [
            'index' => '',
        ],

        'help' => [
            'index' => 'indekss',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => 'grozs',
            'orders' => 'pasūtījumu vēsture',
            'products' => 'produkti',
        ],

        'tournaments' => [
            'index' => '',
        ],

        'users' => [
            'modding' => 'modēšana',
            'playlists' => 'pleiliste',
            'realtime' => 'daudzspēlētāju režīms',
            'show' => 'info',
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
            '_' => 'bītmapes',
        ],
        'community' => [
            '_' => 'kopiena',
            'dev' => 'izstrāde',
        ],
        'help' => [
            '_' => 'palīdzība',
            'getAbuse' => 'ziņot par pārkāpumu',
            'getFaq' => 'bieži uzdoti jautājumi',
            'getRules' => 'noteikumi',
            'getSupport' => 'nē, patiešām, man vajag palīdzību!',
        ],
        'home' => [
            '_' => 'sākums',
            'team' => 'komanda',
        ],
        'rankings' => [
            '_' => 'rangi',
        ],
        'store' => [
            '_' => 'veikals',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Vispārīgi',
            'home' => 'Sākums',
            'changelog-index' => 'Izmaiņu saraksts',
            'beatmaps' => '',
            'download' => 'Lejupielādēt osu!',
        ],
        'help' => [
            '_' => 'Palīdzība & Kopiena',
            'faq' => 'Biežāk Uzdotie Jautājumi',
            'forum' => 'Kopienas forumi',
            'livestreams' => 'Tiešraides',
            'report' => 'Ziņot par problēmu',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => '',
            'copyright' => 'Autortiesības (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Konfidencialitāte',
            'server_status' => 'Servera stāvoklis',
            'source_code' => 'Pirmkods',
            'terms' => 'Nosacījumi',
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
            'error' => "Tev šeit nevajedzētu būt.",
            'description' => 'Vari mēģināt iet atpakaļ, tomēr.',
        ],
        '401' => [
            'error' => "Tev šeit nevajedzētu būt.",
            'description' => '',
        ],
        '405' => [
            'error' => 'Lapas Trūkst',
            'description' => "",
        ],
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '429' => [
            'error' => 'Reitinga limits pārsniegts',
            'description' => '',
        ],
        '500' => [
            'error' => 'Ak nē! Kaut kas salūza! ;_;',
            'description' => "",
        ],
        'fatal' => [
            'error' => 'Ak nē! Kaut kas salūza (ļoti)! ;_;',
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
            'download' => 'Lejupielādēt',
            'info' => 'Lejupielādēt osu!, lai izveidotu savu kontu!',
            'title' => "Nav vēl konta?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Iestatījumi',
            'follows' => '',
            'friends' => 'Draugi',
            'legacy_score_only_toggle' => '',
            'legacy_score_only_toggle_tooltip' => '',
            'logout' => 'Iziet',
            'profile' => 'Mans Profils',
            'scoring_mode_toggle' => '',
            'scoring_mode_toggle_tooltip' => '',
        ],
    ],

    'popup_search' => [
        'initial' => 'Rakstiet, lai meklētu!',
        'retry' => 'Meklēšana neizdevās. Spiediet, lai atkārtotu.',
    ],
];
