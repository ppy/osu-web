<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Stáhnout nyní',
        'online' => '<strong>:players</strong> právě v <strong>:games</strong> hrách',
        'peak' => 'Vrchol, :count online uživatelů',
        'players' => '<strong>:count</strong> registrovaných hráčů',
        'title' => 'vítejte',
        'see_more_news' => 'zobrazit další novinky',

        'slogan' => [
            'main' => 'nejlepšejší free-to-win rytmická hra',
            'sub' => 'rytmus je na dosah jen jednoho kliknutí',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pokročilé vyhledávání',
        'button' => 'Hledat',
        'empty_result' => 'Nebylo nic nenalezeno!',
        'keyword_required' => '',
        'placeholder' => 'zadejte hledaný výraz',
        'title' => 'hledat',

        'beatmapset' => [
            'login_required' => 'Pro hledání beatmap se přihlaste',
            'more' => ':count dalších výsledků vyhledávání map',
            'more_simple' => 'Zobrazit další výsledky vyhledávání map',
            'title' => 'Beatmapy',
        ],

        'forum_post' => [
            'all' => 'Všechna fóra',
            'link' => 'Prohledat fórum',
            'login_required' => 'Pro hledání na fóru se přihlaste',
            'more_simple' => 'Zobrazit další výsledky z prohledávání fór',
            'title' => 'Fórum',

            'label' => [
                'forum' => 'hledat ve fórech',
                'forum_children' => 'zahrnout subfóra',
                'topic_id' => 'téma #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'vše',
            'beatmapset' => 'beatmap',
            'forum_post' => 'fórum',
            'user' => 'hráč',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Pro hledání uživatelů se přihlaste',
            'more' => ':count dalších výsledků vyhledávání hráčů',
            'more_simple' => 'Zobrazit další výsledky vyhledávání hráčů',
            'more_hidden' => 'Vyhledávání hráčů je omezeno na :max hráčů. Zkus upravit tvé vyhledávání.',
            'title' => 'Hráči',
        ],

        'wiki_page' => [
            'link' => 'Prohledat wiki',
            'more_simple' => 'Zobrazit další výsledky z prohledávání wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "pusťme se<br>do toho!",
        'action' => 'Stáhnout osu!',

        'help' => [
            '_' => 'pokud máš problém se spuštěním hry nebo registrací účtu, tak :help_forum_link nebo :support_button.',
            'help_forum_link' => 'se podívej na fórum s nápovědou',
            'support_button' => 'kontaktuj podporu',
        ],

        'os' => [
            'windows' => 'pro Windows',
            'macos' => 'pro macOS',
            'linux' => 'pro Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'macOS uživatelé',
        'steps' => [
            'register' => [
                'title' => 'založte si účet',
                'description' => 'při spuštění hry postupuj podle pokynů pro přihlášení nebo vytvoření nového účtu',
            ],
            'download' => [
                'title' => 'stáhni hru',
                'description' => 'klikni na tlačítko výše a stáhni instalační program, potom ho spusť!',
            ],
            'beatmaps' => [
                'title' => 'získej beatmapy',
                'description' => [
                    '_' => 'pak už zbývá jen :browse rozsáhlou knihovnu uživateli tvořených map a pustit se do hraní!',
                    'browse' => 'projít',
                ],
            ],
        ],
        'video-guide' => 'videonávod',
    ],

    'user' => [
        'title' => 'nástěnka',
        'news' => [
            'title' => 'Novinky',
            'error' => 'Chyba načítání novinek, zkuste obnovit stránku?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Přátelé online',
                'games' => 'Her',
                'online' => 'Uživatelé online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nově hodnocené beatmapy',
            'popular' => 'Populární beatmapy',
            'by_user' => 'od :user',
        ],
        'buttons' => [
            'download' => 'Stáhnout osu!',
            'support' => 'Podpoř osu!',
            'store' => 'osu!store',
        ],
    ],
];
