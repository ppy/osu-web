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
        'download' => 'Stiahni teraz',
        'online' => '<strong>:players</strong> momentálne v <strong>:games</strong> hre',
        'peak' => 'Vrchol, :count online užívateľov',
        'players' => '<strong>:count</strong> registrovaných hráčov',
        'title' => '',

        'slogan' => [
            'main' => 'najlepšia free-to-win rytmická hra',
            'sub' => 'rytmus je iba o klikaní',
        ],
    ],

    'search' => [
        'advanced_link' => 'Pokročilé vyhľadávanie',
        'button' => 'Hľadať',
        'empty_result' => 'Nič sa nenašlo!',
        'placeholder' => 'zadajte pre vyhľadávanie',
        'title' => 'Hľadať',

        'beatmapset' => [
            'more' => ':count ďalších výsledkov vyhladávaní máp',
            'more_simple' => 'Zobraziť ďalšie výsledký vyhladávania máp',
            'title' => 'Beatmapy',
        ],

        'forum_post' => [
            'all' => 'Všetky fóra',
            'link' => 'Prehľadať fórum',
            'more_simple' => 'Zobraziť ďalšie výsledky prehľadávania fóra',
            'title' => 'Fórum',

            'label' => [
                'forum' => 'hľadať vo fóroch',
                'forum_children' => 'zahrnúť subfóra',
                'topic_id' => 'téma #',
                'username' => 'autor',
            ],
        ],

        'mode' => [
            'all' => 'všetko',
            'beatmapset' => 'beatmapy',
            'forum_post' => 'fórum',
            'user' => 'hráč',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count ďalších výsledkov vyhľadávania hráčov',
            'more_simple' => 'Zobraziť ďalśie výsledky vyhľadávania hráčov',
            'more_hidden' => 'Vyhľadávanie hráčov bolo obmedzené na :max hráčov. Skús upraviť tvoje vyhľadávanie.',
            'title' => 'Hráči',
        ],

        'wiki_page' => [
            'link' => 'Prehľadať wiki',
            'more_simple' => 'Zobraziť ďalšie výsledky prehľadávaním wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "poďme začať!",
        'action' => 'Sťahovať!',
        'os' => [
            'windows' => 'pre Windows',
            'macos' => 'pre macOS',
            'linux' => 'pre Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'macOS užívateľ',
        'steps' => [
            'register' => [
                'title' => 'vytvorte si účet',
                'description' => 'pri spustení hry postupuj podľa pokynov pre prihlásenie alebo vytvorenie účtu',
            ],
            'download' => [
                'title' => 'stiahni hru',
                'description' => 'klikni na tlačítko vyššie a stiahni inštalačný program, potom ho spusti!',
            ],
            'beatmaps' => [
                'title' => 'získaj beatmapy',
                'description' => [
                    '_' => 'potom už ostáva iba :browse rozsiahlu knihovňu použivateľmi vytvorených máp a pustiť sa do hrania!',
                    'browse' => 'prehľadávať',
                ],
            ],
        ],
        'video-guide' => 'video návod',
    ],

    'user' => [
        'title' => 'nástenka',
        'news' => [
            'title' => 'Novinky',
            'error' => 'Nastala chyba pri načítavaní noviniek, skúste obnoviť stránku?...',
        ],
        'header' => [
            'welcome' => 'Vitaj, <strong>:username</strong>!',
            'messages' => 'Máte :count novú správu|Máte :count nové správy|Máte :count nových správ',
            'stats' => [
                'friends' => 'Online Priatelia',
                'games' => 'Hry',
                'online' => 'Online užívatelia',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nové Hodnotené Beatmapy',
            'popular' => 'Populárne Beatmapy',
            'by' => 'od',
            'plays' => ':count prehraní',
        ],
        'buttons' => [
            'download' => 'Sťahovať osu!',
            'support' => 'Podpor osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Vyzerá to, že sa dobre bavíš! :D',
        'body' => [
            'part-1' => 'Vedel si, že osu! beží bez reklam a spolieha sa iba na hráčov, aby podporili rozvoj a prevádzkové náklady?',
            'part-2' => 'A tiež si vedel, že podporením osu! získaš veľa užitočných východ, ako napríklad <strong>in-game sťahovanie</strong>, ktoré sa automatický spustí pri pozeraní a multiplayer hrách?',
        ],
        'find-out-more' => 'Klikni tu aby si zistil viac!',
        'download-starting' => "Oh, a nemaj obavy - tvoje sťahovanie sa už začalo ;)",
    ],
];
