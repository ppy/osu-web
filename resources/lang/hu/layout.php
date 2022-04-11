<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Következő zene automatikus lejátszása',
    ],

    'defaults' => [
        'page_description' => 'osu! - Ritmus csak egy *kattintásra*! Quendan/EBA, Taiko és más eredeti játékmódok, emellett egy teljes pálya szerkesztő.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'beatmapset coverek',
            'contest' => 'verseny',
            'contests' => 'versenyek',
            'root' => 'konzol',
        ],

        'artists' => [
            'index' => 'listázás',
        ],

        'changelog' => [
            'index' => 'listázás',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Oldaltérkép',
        ],

        'store' => [
            'cart' => 'kosár',
            'orders' => 'rendelési előzmények',
            'products' => 'termékek',
        ],

        'tournaments' => [
            'index' => 'listázás',
        ],

        'users' => [
            'modding' => 'modolás',
            'playlists' => '',
            'realtime' => '',
            'show' => 'információ',
        ],
    ],

    'gallery' => [
        'close' => 'Bezár (Esc)',
        'fullscreen' => 'Teljes képernyő be/ki',
        'zoom' => 'Nagyítás/kicsinyítés',
        'previous' => 'Előző (bal kurzor)',
        'next' => 'Következő (jobb kurzor)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmap-ek',
        ],
        'community' => [
            '_' => 'közösség',
            'dev' => 'fejlesztés',
        ],
        'help' => [
            '_' => 'segítség',
            'getAbuse' => 'visszaélés jelentése',
            'getFaq' => 'gyik',
            'getRules' => 'szabályok',
            'getSupport' => 'nem, tényleg segítség kell!',
        ],
        'home' => [
            '_' => 'főoldal',
            'team' => 'csapat',
        ],
        'rankings' => [
            '_' => 'rangsor',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'áruház',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Általános',
            'home' => 'Főoldal',
            'changelog-index' => 'Változtatások',
            'beatmaps' => 'Beatmap lista',
            'download' => 'osu! letöltése',
        ],
        'help' => [
            '_' => 'Segítség & Közösség',
            'faq' => 'Gyakran Ismételt Kérdések',
            'forum' => 'Közösségi Fórumok',
            'livestreams' => 'Élő közvetítések',
            'report' => 'Hiba Jelentése',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Jogok és Állapot',
            'copyright' => 'Szerzői jog (DMCA)',
            'privacy' => 'Adatvédelem',
            'server_status' => 'Szerver Állapot',
            'source_code' => 'Forráskód',
            'terms' => 'Felhasználási Feltételek',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Érvénytelen lekérési paraméterek',
            'description' => '',
        ],
        '404' => [
            'error' => 'Hiányzó Oldal',
            'description' => "Bocsi, de a kért oldal nem itt van!",
        ],
        '403' => [
            'error' => "Nem kellene itt lenned.",
            'description' => 'Megpróbálhatnál talán visszamenni.',
        ],
        '401' => [
            'error' => "Nem kellene itt lenned.",
            'description' => 'Megpróbálhatnál talán visszamenni. Vagy bejelentkezni.',
        ],
        '405' => [
            'error' => 'Hiányzó Oldal',
            'description' => "Bocsi, de a kért oldal nem itt van!",
        ],
        '422' => [
            'error' => 'Érvénytelen lekérési paraméterek',
            'description' => '',
        ],
        '429' => [
            'error' => 'Ráta korlát túllépve',
            'description' => '',
        ],
        '500' => [
            'error' => 'Jaj ne! Valami elromlott! ;_;',
            'description' => "Automatikusan értesítve vagyunk minden hibáról.",
        ],
        'fatal' => [
            'error' => 'Jaj ne! Valami (nagyon) elromlott! ;_;',
            'description' => "Automatikusan értesítve vagyunk minden hibáról.",
        ],
        '503' => [
            'error' => 'Karbantartás miatt szünetel!',
            'description' => "A karbantartás általában 5 másodperc és 10 perc közötti időt vesz igénybe. Ha esetleg tovább tartana, lásd :link bővebb információért.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Mindenesetre itt egy kód amit az ügyfélszolgálatnak tudsz adni!",
    ],

    'popup_login' => [
        'button' => 'bejelentkezés / regisztráció',

        'login' => [
            'forgot' => "Elfelejtettem az adataimat",
            'password' => 'jelszó',
            'title' => 'Jelentkezz Be A Folytatáshoz',
            'username' => 'felhasználónév',

            'error' => [
                'email' => "A felhasználónév vagy e-mail cím nem létezik",
                'password' => 'Hibás jelszó',
            ],
        ],

        'register' => [
            'download' => 'Letöltés',
            'info' => 'Önnek szüksége van egy fiókra uram. Miért nem rendelkezik még egyel?',
            'title' => "Nincs még fiókod?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Beállítások',
            'follows' => 'Figyelőlisták',
            'friends' => 'Barátok',
            'logout' => 'Kijelentkezés',
            'profile' => 'Profilom',
        ],
    ],

    'popup_search' => [
        'initial' => 'Keresendő szöveg!',
        'retry' => 'A keresés eredménytelen. Kattintson az ismételt próbálkozáshoz.',
    ],
];
