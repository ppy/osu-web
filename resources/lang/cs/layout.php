<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Přehrát další skladbu automaticky',
    ],

    'defaults' => [
        'page_description' => 'osu! - Rytmus je na dosah jen jednoho *kliknutí*! Spolu s Ouendan/EBA, Taikem, originálními herními módy a také plně funkčním level editorem.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'překrytí beatmapsetu',
            'contest' => 'soutěž',
            'contests' => 'soutěže',
            'root' => 'konzole',
        ],

        'artists' => [
            'index' => 'seznam',
        ],

        'beatmapsets' => [
            'show' => 'info',
            'discussions' => 'diskuze',
        ],

        'changelog' => [
            'index' => 'výpis',
        ],

        'help' => [
            'index' => 'index',
            'sitemap' => 'Mapa stránek',
        ],

        'store' => [
            'cart' => 'košík',
            'orders' => 'historie objednávek',
            'products' => 'položky',
        ],

        'tournaments' => [
            'index' => 'seznam',
        ],

        'users' => [
            'modding' => 'módování',
            'playlists' => 'playlisty',
            'realtime' => 'multiplayer',
            'show' => 'informace',
        ],
    ],

    'gallery' => [
        'close' => 'Zavřít (Esc)',
        'fullscreen' => 'Přepnout režim celé obrazovky',
        'zoom' => 'Přiblížit/Oddálit',
        'previous' => 'Předchozí (šipka vlevo)',
        'next' => 'Další (šipka vpravo)',
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
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Právní záležitosti & Stav serveru',
            'copyright' => 'Autorské právo (DMCA)',
            'jp_sctl' => '',
            'privacy' => 'Soukromí',
            'server_status' => 'Stav serveru',
            'source_code' => 'Zdrojový kód',
            'terms' => 'Podmínky',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => 'Neplatný parametr požadavku',
            'description' => '',
        ],
        '404' => [
            'error' => 'Stránka chybí',
            'description' => "Omlouváme se, ale požadovaná stránka nebyla nalezena!",
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
            'description' => "Omlouváme se, ale požadovaná stránka nebyla nalezena!",
        ],
        '422' => [
            'error' => 'Neplatný parametr požadavku',
            'description' => '',
        ],
        '429' => [
            'error' => 'Překročen limit',
            'description' => '',
        ],
        '500' => [
            'error' => 'Ale ne! Něco se pokazilo! ;_;',
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
        'button' => 'přihlásit se / vytvořit účet',

        'login' => [
            'forgot' => "Zapomněl jsem své údaje",
            'password' => 'heslo',
            'title' => 'Pro pokračování se přihlaste',
            'username' => 'uživatelské jméno',

            'error' => [
                'email' => "Uživatelské jméno nebo emailová adresa neexistují",
                'password' => 'Nesprávné heslo',
            ],
        ],

        'register' => [
            'download' => 'Stáhnout',
            'info' => 'Stáhněte si osu! pro vytvoření vlastního účtu!',
            'title' => "Nemáte účet?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Nastavení',
            'follows' => 'Sledované položky',
            'friends' => 'Přátelé',
            'legacy_score_only_toggle' => 'Lazer režim',
            'legacy_score_only_toggle_tooltip' => 'Lazer režim zobrazuje skóre zahraná na lazeru s novým skórovacím algoritmem',
            'logout' => 'Odhlásit se',
            'profile' => 'Můj profil',
            'scoring_mode_toggle' => 'Klasické skórování',
            'scoring_mode_toggle_tooltip' => 'Upravit hodnoty skóre tak, aby se více podobaly klasickému neomezenému skórování',
            'team' => '',
        ],
    ],

    'popup_search' => [
        'initial' => 'Zadejte hledaný výraz!',
        'retry' => 'Hledání se nezdařilo. Klepněte na tlačítko Opakovat.',
    ],
];
