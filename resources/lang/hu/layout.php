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
            'beatmapset_covers' => 'beatmapset események',
            'contest' => 'verseny',
            'contests' => 'versenyek',
            'root' => 'konzol',
            'store_orders' => 'admin bolt',
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
            'artists' => 'kiemelt előadók',
            'index' => 'lista',
            'packs' => 'csomagok',
        ],
        'community' => [
            '_' => 'közösség',
            'chat' => 'chat',
            'contests' => 'versenyek',
            'dev' => 'fejlesztés',
            'forum-forums-index' => 'fórumok',
            'getLive' => 'élő',
            'tournaments' => 'versenyek',
        ],
        'help' => [
            '_' => 'segítség',
            'getAbuse' => 'visszaélés jelentése',
            'getFaq' => 'gyik',
            'getRules' => 'szabályok',
            'getSupport' => 'nem, tényleg segítség kell!',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'főoldal',
            'changelog-index' => 'változtatások',
            'getDownload' => 'letöltés',
            'news-index' => 'újdonságok',
            'search' => 'keresés',
            'team' => 'csapat',
        ],
        'rankings' => [
            '_' => 'rangsor',
            'charts' => 'kiemeltek',
            'country' => 'ország',
            'index' => 'teljesítmény',
            'kudosu' => 'kudosu',
            'multiplayer' => 'többjátékos',
            'score' => 'pontszám',
        ],
        'store' => [
            '_' => 'áruház',
            'cart-show' => 'kosár',
            'getListing' => 'lista',
            'orders-index' => 'rendelési előzmények',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Általános',
            'home' => 'Főoldal',
            'changelog-index' => 'Változtatások',
            'beatmaps' => 'Beatmap Lista',
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
