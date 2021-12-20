<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Afspil næste sang automatisk',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rytme er kun et *klik* væk!  Med Ouendan/EBA, Taiko og originale spil-modes, såvel som en fuld funktionel level-editor.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'beatmapset covers',
            'contest' => 'konkurrence',
            'contests' => 'konkurrencer',
            'root' => 'konsol',
        ],

        'artists' => [
            'index' => 'katalog',
        ],

        'changelog' => [
            'index' => 'katalog',
        ],

        'help' => [
            'index' => 'indeks',
            'sitemap' => 'Sitemap',
        ],

        'store' => [
            'cart' => 'indkøbskurv',
            'orders' => 'ordrehistorik',
            'products' => 'produkter',
        ],

        'tournaments' => [
            'index' => 'katalog',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => '',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Luk (Esc)',
        'fullscreen' => 'Skift til fuldskærm',
        'zoom' => 'Zoom ind/ud',
        'previous' => 'Forrige (højre pil)',
        'next' => 'Næste (ventre pil)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'fællesskab',
            'dev' => 'udvikling',
        ],
        'help' => [
            '_' => 'hjælp',
            'getAbuse' => 'anmeld misbrug',
            'getFaq' => 'faq',
            'getRules' => 'regler',
            'getSupport' => 'nej, jeg behøver virkelig noget hjælp!',
        ],
        'home' => [
            '_' => 'hjem',
            'team' => 'team',
        ],
        'rankings' => [
            '_' => 'rangering',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'butik',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Generelt',
            'home' => 'Hjem',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Beatmap Lister',
            'download' => 'Download osu!',
        ],
        'help' => [
            '_' => 'Hjælp og Fællesskab',
            'faq' => 'Ofte Stillede Spørgsmål',
            'forum' => 'Fællesskabsforummer',
            'livestreams' => 'Live Streams',
            'report' => 'Rapportér en Fejl',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Legal & Status',
            'copyright' => 'Copyright (DMCA)',
            'privacy' => 'Privatliv',
            'server_status' => 'Server Status',
            'source_code' => 'Kildekode',
            'terms' => 'Betingelser for Brug',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Ugyldigt forespørgselsparametre',
            'description' => '',
        ],
        '404' => [
            'error' => 'Siden findes ikke',
            'description' => "Beklager, men siden du forsøger at finde, eksisterer ikke!",
        ],
        '403' => [
            'error' => "Du burde ikke være her.",
            'description' => 'Du kunne prøve at gå tilbage igen, okay?',
        ],
        '401' => [
            'error' => "Du burde ikke være her.",
            'description' => 'Du kunne prøve at gå tilbage igen, okay? Eller bare logge ind måske.',
        ],
        '405' => [
            'error' => 'Siden findes ikke',
            'description' => "Beklager, men siden, du forsøger at finde, eksisterer ikke!!",
        ],
        '422' => [
            'error' => 'Ugyldige forespørgselsparametre',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Åh nej! Der er noget galt! ;_;',
            'description' => "Vi er blevet informeret om fejlen.",
        ],
        'fatal' => [
            'error' => 'Åh nej! Der er noget (voldsomt) galt! ;_;',
            'description' => "Vi er blevet informeret om fejlen.",
        ],
        '503' => [
            'error' => 'Under Vedligeholdelse!',
            'description' => "Vedligeholdelse tager som regel mellem 5 sekunder og 10 minutter. Hvis siden er nede i længere tid, se :link for mere information.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Her er en kode, som du kan sige videre til support, hvis du vil!",
    ],

    'popup_login' => [
        'button' => 'log ind / Tilmeld',

        'login' => [
            'forgot' => "Jeg har glemt min login-info",
            'password' => 'adgangskode',
            'title' => 'Log ind for at fortsætte',
            'username' => 'brugernavn',

            'error' => [
                'email' => "Brugernavn eller email-addresse eksisterer ikke",
                'password' => 'Forkert adgangskode',
            ],
        ],

        'register' => [
            'download' => 'Hent',
            'info' => 'Du skal have en konto, min gode mand! Hvor har du ikke én endnu?',
            'title' => "Har du ikke en konto?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Indstillinger',
            'follows' => 'Overvågningsliste',
            'friends' => 'Venner',
            'logout' => 'Log ud',
            'profile' => 'Min Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Skriv for at søge!',
        'retry' => 'Søgningen fejlede. Prøv igen.',
    ],
];
