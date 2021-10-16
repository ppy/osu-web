<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Spill neste spor automatisk',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rytmen er bare et *klikk* unna! Med Ouendan/EBA, Taiko og originale spillmoduser, samt en fullt funskjonell nivåredigerer.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapsett',
            'beatmapset_covers' => 'beatmapsettomslag',
            'contest' => 'konkurranse',
            'contests' => 'konkurranser',
            'root' => 'konsoll',
        ],

        'artists' => [
            'index' => 'liste',
        ],

        'changelog' => [
            'index' => 'liste',
        ],

        'help' => [
            'index' => 'indeks',
            'sitemap' => 'Nettstedkart',
        ],

        'store' => [
            'cart' => 'handlekurv',
            'orders' => 'bestillingshistorikk',
            'products' => 'produkter',
        ],

        'tournaments' => [
            'index' => 'liste',
        ],

        'users' => [
            'modding' => 'modding',
            'multiplayer' => '',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Lukk (Esc)',
        'fullscreen' => 'Fullskjermsvisning av/på',
        'zoom' => 'Zoom inn/ut',
        'previous' => 'Forrige (pil venstre)',
        'next' => 'Neste (pil høyre)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
        ],
        'community' => [
            '_' => 'samfunnet',
            'dev' => 'utvikling',
        ],
        'help' => [
            '_' => 'hjelp',
            'getAbuse' => '',
            'getFaq' => 'faq',
            'getRules' => 'regler',
            'getSupport' => 'nei, virkelig, jeg trenger hjelp!',
        ],
        'home' => [
            '_' => 'hjem',
            'team' => 'skapere',
        ],
        'rankings' => [
            '_' => 'rangering',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'butikk',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Generelt',
            'home' => 'Hjem',
            'changelog-index' => 'Endringslogg',
            'beatmaps' => 'Beatmapliste',
            'download' => 'Last ned osu!',
        ],
        'help' => [
            '_' => 'Hjelp & Samfunn',
            'faq' => 'Ofte Stilte Spørsmål',
            'forum' => 'Brukerforum',
            'livestreams' => 'Direktesendinger',
            'report' => 'Rapportér en feil',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Juridisk & Status',
            'copyright' => 'Opphavsrett (DMCA)',
            'privacy' => 'Personvern',
            'server_status' => 'Serverstatus',
            'source_code' => 'Kildekode',
            'terms' => 'Vilkår for bruk',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Ugyldig parameter i forespørsel',
            'description' => '',
        ],
        '404' => [
            'error' => 'Siden mangler',
            'description' => "Beklager, men siden som du forespurte er ikke her!",
        ],
        '403' => [
            'error' => "Du burde ikke være her.",
            'description' => 'Du kan derimot forsøke å gå tilbake.',
        ],
        '401' => [
            'error' => "Du burde ikke være her.",
            'description' => 'Du kan derimot forsøke å gå tilbake. Eller kanskje logge inn.',
        ],
        '405' => [
            'error' => 'Siden mangler',
            'description' => "Beklager, men siden du forespurte er ikke her!",
        ],
        '422' => [
            'error' => 'Ugyldig parameter i forespørsel',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Åh nei! Noe gikk i stykker! ;_;',
            'description' => "Vi blir automatisk informert om hver feilstilling.",
        ],
        'fatal' => [
            'error' => 'Åh nei! noe gikk virkelig i stykker! ;_;',
            'description' => "Vi blir automatisk informert om hver feilstilling.",
        ],
        '503' => [
            'error' => 'Nede for vedlikehold!',
            'description' => "Vedlikehold tar vanligvis noen steder mellom 5 sekunder til 10 minutter. Hvis vi er nede lengre enn dette, se :link for mer informasjon.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Bare i tilfelle, her er en kode du kan gi til brukerstøtte!",
    ],

    'popup_login' => [
        'button' => '',

        'login' => [
            'forgot' => "Jeg har glemt kontoinformasjonen min",
            'password' => 'passord',
            'title' => 'Logg på for å fortsette',
            'username' => 'brukernavn',

            'error' => [
                'email' => "Brukernavn eller e-postadresse eksisterer ikke",
                'password' => 'Ugyldig passord',
            ],
        ],

        'register' => [
            'download' => 'Last ned',
            'info' => 'Du trenger en konto, min gode mann. Hvorfor har du ikke en allerede?',
            'title' => "Har du ikke en konto?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Innstillinger',
            'follows' => '',
            'friends' => 'Venner',
            'logout' => 'Logg Ut',
            'profile' => 'Min Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Skriv for å søke!',
        'retry' => 'Søk mislykket. Klikk for å prøve på nytt.',
    ],
];
