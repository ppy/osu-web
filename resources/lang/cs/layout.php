<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => '',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rytmus je na dosah jen jednoho *kliknutí*! Spolu s Ouendan/EBA, Taikem, originálními herními módy a také plně funkčním level editorem.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => 'soutěž',
            'contests' => 'soutěže',
            'root' => 'konzole',
        ],

        'artists' => [
            'index' => '',
        ],

        'changelog' => [
            'index' => 'výpis',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => 'košík',
            'orders' => 'historie objednávek',
            'products' => 'položky',
        ],

        'tournaments' => [
            'index' => '',
        ],

        'users' => [
            'modding' => 'módování',
            'multiplayer' => '',
            'show' => 'informace',
        ],
    ],

    'gallery' => [
        'close' => 'Zavřít (Esc)',
        'fullscreen' => '',
        'zoom' => 'Přiblížit/Oddálit',
        'previous' => '',
        'next' => '',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmapy',
        ],
        'community' => [
            '_' => 'komunita',
            'dev' => 'vývoj',
        ],
        'help' => [
            '_' => 'nápověda',
            'getAbuse' => 'nahlásit zneužití',
            'getFaq' => 'časté dotazy',
            'getRules' => 'pravidla',
            'getSupport' => 'ne, vážně, potřebuji pomoc!',
        ],
        'home' => [
            '_' => 'domů',
            'team' => 'tým',
        ],
        'rankings' => [
            '_' => 'žebříček',
            'kudosu' => 'kudosu',
        ],
        'store' => [
            '_' => 'obchod',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Obecné',
            'home' => 'Domů',
            'changelog-index' => 'Seznam změn',
            'beatmaps' => 'Seznam beatmap',
            'download' => 'Stáhnout osu!',
        ],
        'help' => [
            '_' => 'Nápověda & Komunita',
            'faq' => 'Často kladené otázky',
            'forum' => 'Komunitní fóra',
            'livestreams' => 'Živá vysílání',
            'report' => 'Náhlasit chybu',
            'wiki' => '',
        ],
        'legal' => [
            '_' => 'Právní záležitosti & Stav serveru',
            'copyright' => 'Autorské právo (DMCA)',
            'privacy' => 'Soukromí',
            'server_status' => 'Stav serveru',
            'source_code' => 'Zdrojový kód',
            'terms' => 'Podmínky',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '',
            'description' => '',
        ],
        '404' => [
            'error' => 'Stránka chybí',
            'description' => "Omlouvám se, ale požadovaná stránka není nalezena!",
        ],
        '403' => [
            'error' => "Tady nesmíš být.",
            'description' => 'Můžete se pokusit vrátit zpět.',
        ],
        '401' => [
            'error' => "Tady bys neměl být.",
            'description' => 'Můžete se pokusit vrátit zpět. Nebo možná se přihlásit.',
        ],
        '405' => [
            'error' => 'Stránka chybí',
            'description' => "Omlouvám se, ale požadovaná stránka není nalezena!",
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
            'error' => 'Ale ne, něco je rozbité!',
            'description' => "Jsme automaticky oznámeni o každé chybě.",
        ],
        'fatal' => [
            'error' => 'Ale né! Něco se pokazilo (Fatálně)! ;_;',
            'description' => "Jsme automaticky oznámeni o každé chybě.",
        ],
        '503' => [
            'error' => 'Vypnuté kvůli údržbě!',
            'description' => "Údržby obvykle trvají 5 sekund až 10 minut. Pokud servery nefungují delší dobu, jděte na :link pro více informací.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Tady je kód, který můžeš napsat na podporu!",
    ],

    'popup_login' => [
        'button' => '',

        'login' => [
            'forgot' => "Zapomněl jsem své údaje",
            'password' => 'heslo',
            'title' => 'Pro pokračování se přihlašte',
            'username' => 'uživatelské jméno',

            'error' => [
                'email' => "Uživatelské jméno nebo emailová adresa neexistují",
                'password' => 'Nesprávné heslo',
            ],
        ],

        'register' => [
            'download' => 'Stáhnout',
            'info' => 'Potřebujete účet, pane. Proč již jeden nemáte?',
            'title' => "Nemáte účet?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Nastavení',
            'follows' => '',
            'friends' => 'Přátelé',
            'logout' => 'Odhlásit se',
            'profile' => 'Můj profil',
        ],
    ],

    'popup_search' => [
        'initial' => 'Zadejte hledaný výraz!',
        'retry' => 'Hledání se nezdařilo. Klepněte na tlačítko Opakovat.',
    ],
];
