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
            'error' => 'Nevažeći parametar zahtjeva',
            'description' => '',
        ],
        '404' => [
            'error' => 'Stranica nedostaje',
            'description' => "Žao nam je, ali stranica koju si tražio/la nije ovdje!",
        ],
        '403' => [
            'error' => "Ne bi trebao/la biti ovdje.",
            'description' => 'Ipak, možeš se pokušati vratiti.',
        ],
        '401' => [
            'error' => "Ne bi trebao/la biti ovdje.",
            'description' => 'Ipak, možeš se pokušati vratiti. Ili možda prijaviti.',
        ],
        '405' => [
            'error' => 'Stranica nedostaje',
            'description' => "Žao nam je, ali stranica koju si tražio/la nije ovdje!",
        ],
        '422' => [
            'error' => 'Nevažeći parametar zahtjeva',
            'description' => '',
        ],
        '429' => [
            'error' => 'Ograničenje brzine premašeno',
            'description' => '',
        ],
        '500' => [
            'error' => 'O ne! Nešto se pokvarilo! ;_;',
            'description' => "Automatski smo obaviješteni o svakoj grešci.",
        ],
        'fatal' => [
            'error' => 'O ne! Nešto se (jako) pokvarilo! ;_;',
            'description' => "Automatski smo obaviješteni o svakoj grešci.",
        ],
        '503' => [
            'error' => 'Dolje zbog održavanja!',
            'description' => "Održavanje obično traje od 5 sekundi do 10 minuta. Ako traje dulje, pogledaj :link za više informacija.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Za svaki slučaj, evo koda kojeg možeš dati podršci!",
    ],

    'popup_login' => [
        'button' => 'prijava / registracija',

        'login' => [
            'forgot' => "Zaboravio/la sam svoje podatke",
            'password' => 'lozinka',
            'title' => 'Prijavi se za nastavak',
            'username' => 'korisničko ime',

            'error' => [
                'email' => "Korisničko ime ili adresa e-pošte ne postoji",
                'password' => 'Netočna lozinka',
            ],
        ],

        'register' => [
            'download' => 'Preuzmi',
            'info' => 'Preuzmi osu! za izradu vlastitog računa!',
            'title' => "Nemaš račun?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Postavke',
            'follows' => 'Liste gledanja',
            'friends' => 'Prijatelji',
            'logout' => 'Odjava',
            'profile' => 'Moj profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Unesite za pretraživanje!',
        'retry' => 'Pretraga nije uspjela. Klikni za ponovni pokušaj.',
    ],
];
