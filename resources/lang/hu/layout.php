<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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

    'menu' => [
        'home' => [
            '_' => 'főoldal',
            'account-edit' => 'beállítások',
            'friends-index' => 'barátok',
            'changelog-index' => 'változtatások',
            'changelog-build' => 'verzió',
            'getDownload' => 'letöltés',
            'getIcons' => 'ikonok',
            'groups-show' => 'csoportok',
            'index' => 'áttekintés',
            'legal-show' => 'információ',
            'news-index' => 'újdonságok',
            'news-show' => 'újdonságok',
            'password-reset-index' => 'jelszó visszaállítása',
            'search' => 'keresés',
            'supportTheGame' => 'támogasd a játékot',
            'team' => 'csapat',
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
            'beatmapset-watches-index' => 'modolási figyelőlista',
            'beatmapset_discussion_votes-index' => 'beatmap vita szavazatok',
            'beatmapset_events-index' => 'beatmapszet események',
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
            'dev' => 'fejlesztés',
            'getForum' => 'fórumok',
            'getChat' => 'chat',
            'getLive' => 'élő',
            'contests' => 'versenyek',
            'profile' => 'profil',
            'tournaments' => 'versenyek',
            'tournaments-index' => 'versenyek',
            'tournaments-show' => 'verseny infó',
            'forum-topic-watches-index' => 'feliratkozások',
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

            'messages' => 'Üzenetek',
            'settings' => 'Beállitások',
            'logout' => 'Kilépés',
            'help' => 'Súgó',
            'modding-history-discussions' => 'felhasználói modoló megbeszélések',
            'modding-history-events' => 'felhasználói modoló események',
            'modding-history-index' => 'felhasználói modoló előzmények',
            'modding-history-posts' => 'felhasználói modoló előzmények',
            'modding-history-votesGiven' => 'felhasználói modoló szavazat adva',
            'modding-history-votesReceived' => 'felhasználói modoló szavazat kapva',
        ],
        'store' => [
            '_' => 'áruház',
            'checkout-show' => 'fizetés',
            'getListing' => 'lista',
            'cart-show' => 'kosár',

            'getCheckout' => 'fizetés',
            'getInvoice' => 'számla',
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
            'changelog-index' => 'Változások listája',
            'beatmaps' => 'Beatmap lista',
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
            '_' => 'Jogok és állapot',
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
            'description' => "Bocsánat, de az oldal, amit kértél nincs itt!",
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
            'description' => "Bocsánat, de az oldal, amit kértél nincs itt!",
        ],
        '500' => [
            'error' => 'Oh ne! Valami összetört! ;_;',
            'description' => "Automatikusan értesítve vagyunk minden hibáról.",
        ],
        'fatal' => [
            'error' => 'Jaj ne! Valami összetört (martined)! ;_;',
            'description' => "Automatikusan értesítve vagyunk minden hibáról.",
        ],
        '503' => [
            'error' => 'Karbantartás miatt leállitva!',
            'description' => "A karbantartás általában 5 másodperc és akár 10 perc is lehet. Ha bármi esetben tovább tartana , lásd :link linket bővebb információért.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Mindenesetre, itt egy kód amit a supportnak tudsz adni!",
    ],

    'popup_login' => [
        'login' => [
            'email' => 'e-mail cím',
            'forgot' => "Elfelejtettem az adataimat",
            'password' => 'jelszó',
            'title' => 'Jelentkezz Be A Folytatáshoz',

            'error' => [
                'email' => "A felhasználónév vagy e-mail cím nem létezik",
                'password' => 'Hibás jelszó',
            ],
        ],

        'register' => [
            'info' => "Uram, önnek kell egy fiók. Nem is értem miért nem rendelkezik még egyel?",
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
