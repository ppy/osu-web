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
    'landing' => [
        'download' => 'Stáhnout nyní',
        'online' => '<strong>:players</strong> právě v <strong>:games</strong> hrách',
        'peak' => 'Vrchol, :count online uživatelů',
        'players' => '<strong>:count</strong> registrovaných hráčů',
        'title' => 'vítejte',
        'see_more_news' => 'zlédnout více novinek',

        'slogan' => [
            'main' => 'nejlepší free-to-win rytmická hra',
            'sub' => 'rytmus je jen o klkání',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pokročilé vyhledávání',
        'button' => 'Hledat',
        'empty_result' => 'Nebylo nic nenalezeno!',
        'keyword_required' => '',
        'placeholder' => 'zadejte hledaný výraz',
        'title' => 'Hledat',

        'beatmapset' => [
            'more' => ':count dalších výsledků vyhledávání map',
            'more_simple' => 'Zobrazit další výsledky vyhledávání map',
            'title' => 'Beatmapy',
        ],

        'forum_post' => [
            'all' => 'Všechna fóra',
            'link' => 'Prohledat fórum',
            'more_simple' => 'Zobrazit další výsledky prohledávání fór',
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
            'more' => ':count dalších výsledků vyhledávání hráčů',
            'more_simple' => 'Zobrazit další výsledky vyhledávání hráčů',
            'more_hidden' => 'Vyhledávání hráčů je omezeno na :max hráčů. Zkus upravit tvé vyhledávání.',
            'title' => 'Hráči',
        ],

        'wiki_page' => [
            'link' => 'Prohledat wiki',
            'more_simple' => 'Zobrazit další výsledky prohledávání wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "pusťme se<br>do toho!",
        'action' => 'Stáhnout osu!',
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
            'popular' => 'Populární Beatmapy',
            'by_user' => 'od :user',
        ],
        'buttons' => [
            'download' => 'Stáhnout osu!',
            'support' => 'Podpoř osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Woah!',
        'subtitle' => 'Vypadá to, že se dobře bavíš! :D',
        'body' => [
            'part-1' => 'Věděl jsi, že osu! běží bez reklam a spoléhá se pouze na hráčích, aby podpořili rozvoj a provozní náklady?',
            'part-2' => 'Věděl jsi také, že podpořením osu! získáš spoustu užitečných výhod, jako třeba <strong>in-game stahování</strong> které se automaticky spustí při pozorování a multiplayer hrách?',
        ],
        'find-out-more' => 'Klikni zde abyste zjistili víc!',
        'download-starting' => "Ou, a není se čeho bát - Tvé stahování již bylo zahájeno :)",
    ],
];
