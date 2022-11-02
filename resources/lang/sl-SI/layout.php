<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Avtomatsko predvajaj naslednjo skladbo',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritem je samo *klik* stran!  Z Ouendan/EBA, Taiko in originalnimi igralnimi načini kot tudi polno funkcionalen urejevalnik.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'zbirka beatmap',
            'beatmapset_covers' => 'naslovne slike zbirk beatmap',
            'contest' => 'tekmovanje',
            'contests' => 'tekmovanja',
            'root' => 'konzola',
        ],

        'artists' => [
            'index' => 'seznam',
        ],

        'beatmapsets' => [
            'show' => 'info',
            'discussions' => 'razprava',
        ],

        'changelog' => [
            'index' => 'seznam',
        ],

        'help' => [
            'index' => 'indeks',
            'sitemap' => 'Zemljevid',
        ],

        'store' => [
            'cart' => 'košarica',
            'orders' => 'zgodovina nakupov',
            'products' => 'izdelki',
        ],

        'tournaments' => [
            'index' => 'seznam',
        ],

        'users' => [
            'modding' => '',
            'playlists' => 'seznam pesmi',
            'realtime' => 'večigralski način',
            'show' => 'info',
        ],
    ],

    'gallery' => [
        'close' => 'Zapri (Esc)',
        'fullscreen' => 'Preklopi na celozaslonski način',
        'zoom' => 'Povečaj/Pomanjšaj',
        'previous' => 'Nazaj (puščica levo)',
        'next' => 'Naprej (puščica desno)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmape',
        ],
        'community' => [
            '_' => 'skupnost',
            'dev' => 'razvoj',
        ],
        'help' => [
            '_' => 'pomoč',
            'getAbuse' => 'prijavi zlorabo',
            'getFaq' => 'faq',
            'getRules' => 'pravila',
            'getSupport' => 'ne, resno, potrebujem pomoč!',
        ],
        'home' => [
            '_' => 'domov',
            'team' => 'ekipa',
        ],
        'rankings' => [
            '_' => 'uvrstitve',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'trgovina',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Splošno',
            'home' => 'Domov',
            'changelog-index' => 'Dnevnik sprememb',
            'beatmaps' => 'Seznam beatmap',
            'download' => 'Prenesi osu!',
        ],
        'help' => [
            '_' => 'Pomoč & Skupnost',
            'faq' => 'Pogosta vprašanja',
            'forum' => 'Forumi skupnosti',
            'livestreams' => 'Oddajanja v živo',
            'report' => 'Prijavi težavo',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Pravno & Stanje',
            'copyright' => 'Avtorske pravice (DMCA)',
            'privacy' => 'Zasebnost',
            'server_status' => 'Stanje Strežnika',
            'source_code' => 'Izvorna Koda',
            'terms' => 'Pogoji',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Neveljaven zahtevani parameter',
            'description' => '',
        ],
        '404' => [
            'error' => 'Manjkajoča stran',
            'description' => "Se opravičujemo, ampak željena spletna stran ni tukaj!",
        ],
        '403' => [
            'error' => "Tukaj ne bi smel biti.",
            'description' => 'Mogoče lahko poskusiš vrniti nazaj.',
        ],
        '401' => [
            'error' => "Tukaj ne bi smel biti.",
            'description' => 'Mogoče lahko poskusiš vrniti nazaj. Ali pa se vpišeš.',
        ],
        '405' => [
            'error' => 'Manjkajoča stran',
            'description' => "Se opravičujemo, ampak željena spletna stran ni tukaj!",
        ],
        '422' => [
            'error' => 'Neveljaven zahtevani parameter',
            'description' => '',
        ],
        '429' => [
            'error' => 'Omejitev prekoračena',
            'description' => '',
        ],
        '500' => [
            'error' => 'O ne! Nekaj se je zalomilo! ;_;',
            'description' => "Avtomatsko smo obveščeni ob vsaki napaki.",
        ],
        'fatal' => [
            'error' => 'O ne! Nekaj se je zalomilo (hudo)! ;_;',
            'description' => "Avtomatsko smo obveščeni ob vsaki napaki.",
        ],
        '503' => [
            'error' => 'Dostop zavrnjen zaradi vzdrževanja!',
            'description' => "Vzdrževanje ponavadi traja od 5 sekund do 10 minut. Če vzdrževanje traja dlje, obišči :link za več informacij.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Za vsak slučaj, tukaj je koda, ki jo lahko posreduješ podpori!",
    ],

    'popup_login' => [
        'button' => 'vpiši se / registriraj se',

        'login' => [
            'forgot' => "Pozabil sem svoje podatke",
            'password' => 'geslo',
            'title' => 'Vpiši se za nadaljevanje',
            'username' => 'uporabniško ime',

            'error' => [
                'email' => "Uporabniško ime ali e-poštni naslov ne obstaja",
                'password' => 'Nepravilno geslo',
            ],
        ],

        'register' => [
            'download' => 'Prenesi',
            'info' => 'Prenesi osu!, da lahko ustvariš svoj račun!',
            'title' => "Še nimaš računa?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Nastavitve',
            'follows' => '',
            'friends' => 'Prijatelji',
            'logout' => 'Odjavi se',
            'profile' => 'Moj profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Vpiši za iskanje!',
        'retry' => 'Iskanje neuspešno. Klikni za ponovni poskus.',
    ],
];
