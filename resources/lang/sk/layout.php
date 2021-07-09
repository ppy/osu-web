<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rytmus je len o klikaní! Spolu s Quendan/EBA, Taikem a originálnými hernými módmi a plne funkčným level editorom.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => '',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            'index' => '',
        ],

        'changelog' => [
            'index' => '',
        ],

        'help' => [
            'index' => '',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => '',
            'orders' => '',
            'products' => '',
        ],

        'tournaments' => [
            'index' => '',
        ],

        'users' => [
            'modding' => '',
            'multiplayer' => '',
            'show' => 'informácie',
        ],
    ],

    'gallery' => [
        'close' => '',
        'fullscreen' => '',
        'zoom' => '',
        'previous' => '',
        'next' => '',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmapy',
            'artists' => 'významní umelci',
            'index' => 'výpis',
            'packs' => 'balíčky',
        ],
        'community' => [
            '_' => 'komunita',
            'chat' => 'konverzácia',
            'contests' => 'súťaže',
            'dev' => 'vývoj',
            'forum-forums-index' => 'fórum',
            'getLive' => 'naživo',
            'tournaments' => 'turnaje',
        ],
        'help' => [
            '_' => 'pomoc',
            'getAbuse' => '',
            'getFaq' => 'faq',
            'getRules' => 'pravidlá',
            'getSupport' => 'nie, vážne, potrebujem pomoc!',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'domov',
            'changelog-index' => 'záznam zmien',
            'getDownload' => 'stiahnúť',
            'news-index' => 'novinky',
            'search' => 'hľadať',
            'team' => 'tím',
        ],
        'rankings' => [
            '_' => 'rebríčky',
            'charts' => 'výber',
            'country' => 'krajina',
            'index' => 'výkon',
            'kudosu' => 'kudosu',
            'multiplayer' => '',
            'score' => 'skóre',
        ],
        'store' => [
            '_' => 'obchod',
            'cart-show' => 'košík',
            'getListing' => 'výpis',
            'orders-index' => 'história objednávok',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Všeobecné',
            'home' => 'Domov',
            'changelog-index' => 'Zoznam zmien',
            'beatmaps' => 'Zoznam beatmap',
            'download' => 'Stiahnuť osu!',
        ],
        'help' => [
            '_' => 'Pomoc & Komunita',
            'faq' => 'Často Kladené Otázky',
            'forum' => 'Komunitné Fóra',
            'livestreams' => 'Živé Vysielania',
            'report' => 'Nahlásiť Chybu',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Právne záležitosti & Stav serveru',
            'copyright' => 'Autorské práva (DMCA)',
            'privacy' => 'Súkromie',
            'server_status' => 'Stav Serveru',
            'source_code' => 'Zdrojový Kód',
            'terms' => 'Podmienky',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '',
            'description' => '',
        ],
        '404' => [
            'error' => 'Stránka Chýba',
            'description' => "Prepáčte, ale požadovaná stránka tu nie je!",
        ],
        '403' => [
            'error' => "Tu by si nemal byť.",
            'description' => 'Môžete sa pokúsiť vrátiť späť.',
        ],
        '401' => [
            'error' => "Tu by si nemal byť.",
            'description' => 'Môžete sa pokúsiť vrátiť späť. Alebo sa možno prihlásiť.',
        ],
        '405' => [
            'error' => 'Stránka Chýba',
            'description' => "Prepáčte, ale požadovaná stránka tu nie je!",
        ],
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Ale nie! Niečo sa pokazilo! ;_;',
            'description' => "Sme automaticky oznámení o každej chybe.",
        ],
        'fatal' => [
            'error' => 'Ale nie! Niečo sa pokazilo (vážne)! ;_;',
            'description' => "Sme automaticky oznámení o každej chybe.",
        ],
        '503' => [
            'error' => 'Vypnuté kvôli údržbe!',
            'description' => "Údržby zvyčajne trvajú 5 sekúnd až 10 minút. Pokiaľ servery nefungujú dlhšie, choďte :link pre viacej informácií.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Tu je kód, ktorý môžeš napísať na podporu!",
    ],

    'popup_login' => [
        'button' => '',

        'login' => [
            'forgot' => "Zabudol som svoje údaje",
            'password' => 'heslo',
            'title' => 'Pre pokračovanie sa prihláste',
            'username' => '',

            'error' => [
                'email' => "Užívateľské meno alebo e-mailová adresa neexistuje",
                'password' => 'Nesprávne heslo',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => 'Potrebujete účet, pane. Prečo teda jeden nemáte?',
            'title' => "Nemáte účet?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Nastavenia',
            'follows' => '',
            'friends' => 'Priatelia',
            'logout' => 'Odhlásiť Sa',
            'profile' => 'Môj Profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Zadaj hladaný výraz!',
        'retry' => 'Hľadanie sa nepodarilo. Kliknite na Opakovať.',
    ],
];
