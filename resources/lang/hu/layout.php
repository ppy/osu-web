<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
 */

return [
    'defaults' => [
        'page_description' => 'osu! - Ritmus csak egy *kattintásra*! Quendan/EBA, Taiko és más eredeti játékmódok, emellett egy teljes pálya szerkesztő.',
    ],

    'header' => [
        'admin' => [
            '_' => '',
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => '',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            '_' => '',
            'index' => '',
        ],

        'beatmapsets' => [
            '_' => '',
            'discussions' => '',
            'index' => '',
            'show' => '',
            'packs' => '',
        ],

        'changelog' => [
            '_' => '',
            'index' => '',
        ],

        'community' => [
            '_' => 'Közösség',
            'comments' => '',
            'contests' => '',
            'forum' => 'Fórum',
            'livestream' => '',
        ],

        'error' => [
            '_' => '',
        ],

        'help' => [
            '_' => '',
            'index' => '',
        ],

        'home' => [
            '_' => '',
            'password_reset' => '',
        ],

        'matches' => [
            '_' => '',
        ],

        'notice' => [
            '_' => '',
        ],

        'notifications' => [
            '_' => '',
            'index' => '',
        ],

        'rankings' => [
            '_' => '',
        ],

        'store' => [
            '_' => '',
            'cart' => '',
            'order' => '',
            'orders' => '',
            'product' => '',
            'products' => '',
        ],

        'tournaments' => [
            '_' => '',
            'index' => '',
        ],

        'users' => [
            '_' => '',
            'forum_posts' => '',
            'modding' => '',
            'show' => '',
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
        'home' => [
            '_' => 'főoldal',
            'account-edit' => 'beállítások',
            'account-verifyLink' => 'Sikeres hitelesítés',
            'beatmapset-watches-index' => '',
            'changelog-build' => 'verzió',
            'changelog-index' => 'változtatások',
            'client_verifications-create' => '',
            'forum-topic-watches-index' => '',
            'friends-index' => 'barátok',
            'getDownload' => 'letöltés',
            'getIcons' => 'ikonok',
            'groups-show' => 'csoportok',
            'index' => 'áttekintés',
            'legal-show' => 'információ',
            'messages-index' => 'üzenetek',
            'news-index' => 'újdonságok',
            'news-show' => 'újdonságok',
            'password-reset-index' => 'jelszó visszaállítása',
            'search' => 'keresés',
            'supportTheGame' => 'támogasd a játékot',
            'team' => 'csapat',
            'testflight' => '',
        ],
        'profile' => [
            '_' => 'profil',
            'friends' => 'barátok',
            'settings' => 'beállítások',
        ],
        'help' => [
            '_' => 'segítség',
            'getFaq' => 'gyik',
            'getRules' => 'szabályok',
            'getSupport' => 'nem, tényleg segítség kell!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmap-ek',
            'artists' => 'kiemelt előadók',
            'beatmap_discussion_posts-index' => 'beatmap vita posztok',
            'beatmap_discussions-index' => 'beatmap viták',
            'beatmapset_discussion_votes-index' => 'beatmap vita szavazatok',
            'beatmapset_events-index' => 'beatmapszett események',
            'index' => 'lista',
            'packs' => 'csomagok',
            'show' => 'információ',
        ],
        'beatmapsets' => [
            '_' => 'beatmap-ek',
            'discussion' => 'modolás',
        ],
        'rankings' => [
            '_' => 'rangsor',
            'index' => 'teljesítmény',
            'performance' => 'teljesítmény',
            'charts' => 'kiemeltek',
            'score' => 'pontszám',
            'country' => 'ország',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'közösség',
            'chat' => 'chat',
            'chat-index' => 'chat',
            'dev' => 'fejlesztés',
            'getForum' => 'fórumok',
            'getLive' => 'élő',
            'comments-index' => 'hozzászólások',
            'comments-show' => 'hozzászólás',
            'contests' => 'versenyek',
            'profile' => 'profil',
            'tournaments' => 'versenyek',
            'tournaments-index' => 'versenyek',
            'tournaments-show' => 'verseny infó',
            'forum-topics-create' => 'fórumok',
            'forum-topics-show' => 'fórumok',
            'forum-forums-index' => 'fórumok',
            'forum-forums-show' => 'fórumok',
        ],
        'multiplayer' => [
            '_' => 'többjátékos',
            'show' => 'meccs',
        ],
        'error' => [
            '_' => 'hiba',
            '404' => 'hiányzó',
            '403' => 'tiltott',
            '401' => 'jogosulatlan',
            '405' => 'hiányzó',
            '500' => 'valami elromlott',
            '503' => 'karbantartás',
        ],
        'user' => [
            '_' => 'felhasználó',
            'getLogin' => 'belépés',
            'disabled' => 'kikapcsolt',

            'register' => 'regisztráció',
            'reset' => 'visszaállitás',
            'new' => 'új',

            'help' => 'Súgó',
            'logout' => 'Kijelentkezés',
            'messages' => 'Üzenetek',
            'modding-history-discussions' => 'felhasználói modoló megbeszélések',
            'modding-history-events' => 'felhasználói modoló események',
            'modding-history-index' => 'felhasználói modoló előzmények',
            'modding-history-posts' => 'felhasználói modoló előzmények',
            'modding-history-votesGiven' => 'felhasználói modoló szavazat adva',
            'modding-history-votesReceived' => 'felhasználói modoló szavazat kapva',
            'notifications-index' => '',
            'oauth_login' => 'jelentkezz be az oauth-ért',
            'oauth_request' => 'oauth felhatalmazás',
            'settings' => 'Beállitások',
        ],
        'store' => [
            '_' => 'áruház',
            'checkout-show' => 'fizetés',
            'getListing' => 'lista',
            'cart-show' => 'kosár',

            'getCheckout' => 'fizetés',
            'getInvoice' => 'számla',
            'orders-index' => 'rendelési előzmények',
            'products-show' => 'termék',

            'new' => 'új',
            'home' => 'főoldal',
            'index' => 'főoldal',
            'thanks' => 'köszi',
        ],
        'admin-forum' => [
            '_' => '',
            'forum-covers-index' => '',
        ],
        'admin-store' => [
            '_' => '',
            'orders-index' => '',
            'orders-show' => '',
        ],
        'admin' => [
            '_' => '',
            'beatmapsets-covers' => '',
            'logs-index' => '',
            'root' => '',

            'beatmapsets' => [
                '_' => '',
                'show' => '',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Általános',
            'home' => 'Főoldal',
            'changelog-index' => 'Változtatások',
            'beatmaps' => 'Beatmap Lista',
            'download' => 'osu! letöltése',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Segítség & Közösség',
            'faq' => 'Gyakran Ismételt Kérdések',
            'forum' => 'Közösségi Fórumok',
            'livestreams' => 'Élő közvetítések',
            'report' => 'Hiba Jelentése',
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
        'login' => [
            'forgot' => "Elfelejtettem az adataimat",
            'password' => 'jelszó',
            'title' => 'Jelentkezz Be A Folytatáshoz',
            'username' => '',

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
