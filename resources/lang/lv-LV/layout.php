<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Spēlēt nākamo sarakstu automātiski',
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
            'root' => 'konsole',
        ],

        'artists' => [
            'index' => 'saraksts',
        ],

        'beatmapsets' => [
            'show' => 'info',
            'discussions' => 'diskusija',
        ],

        'changelog' => [
            'index' => 'saraksts',
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
            'index' => 'saraksts',
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
            'beatmaps' => 'Ritma-mapju Saraksts',
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
            '_' => 'Legālais & Statuss',
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
            'error' => 'Lapa trūkst',
            'description' => "Piedod, bet lapa kuru tu esi pieprasījis nav šeit!",
        ],
        '403' => [
            'error' => "Tev šeit nevajedzētu būt.",
            'description' => 'Vari mēģināt iet atpakaļ, tomēr.',
        ],
        '401' => [
            'error' => "Tev šeit nevajedzētu būt.",
            'description' => 'Tu varētu mēģināt iet atpakaļ. Vai varbūt pierakstīties.',
        ],
        '405' => [
            'error' => 'Lapas Trūkst',
            'description' => "Piedod, bet lapa kuru tu esi pieprasījis nav šeit!",
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
            'description' => "Mums automātiski paziņo par katru kļūdu.",
        ],
        'fatal' => [
            'error' => 'Ak nē! Kaut kas salūza (ļoti)! ;_;',
            'description' => "Mums automātiski paziņo par katru kļūdu.",
        ],
        '503' => [
            'error' => 'Izslēgts remontdarbu dēļ!',
            'description' => "Parasti remonti var aizņemt no 5 sekundēm līdz 10 minūtēm. Ja remonti notiek ilgāk, apskatīt :link priekš vairāk informācijas.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Tikai drošības dēļ, te ir kods, kuru tu vari iedot atbalstam!",
    ],

    'popup_login' => [
        'button' => 'pierakstīties / reģistrēties',

        'login' => [
            'forgot' => "Esmu aizmirsis/usi savus datus",
            'password' => 'parole',
            'title' => 'Ielogojieties, lai turpinātu',
            'username' => 'lietotājvārds',

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
            'legacy_score_only_toggle' => 'Lazer režīms',
            'legacy_score_only_toggle_tooltip' => 'Lazer režīms rāda rezultātus, kuri ir uzstādīti no lazer ar jauno skaitīšanas algoritmu',
            'logout' => 'Iziet',
            'profile' => 'Mans Profils',
            'scoring_mode_toggle' => 'Klasiskā skaitīšana',
            'scoring_mode_toggle_tooltip' => 'Pielāgot rezultātus klasiskākai vērtēšanas sistēmai',
            'team' => '',
        ],
    ],

    'popup_search' => [
        'initial' => 'Rakstiet, lai meklētu!',
        'retry' => 'Meklēšana neizdevās. Spiediet, lai atkārtotu.',
    ],
];
