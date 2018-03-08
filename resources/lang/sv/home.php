<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'download' => 'Ladda ner nu',
        'online' => '<strong>:players</strong> spelare online i <strong>:games</strong> spel',
        'peak' => 'Som högst, :count spelare online',
        'players' => '<strong>:count</strong> registrerade spelare',

        'slogan' => [
            'main' => 'gratis-att-spela rytm spel',
            'sub' => 'rytmen är bara ett klick bort',
        ],
    ],

    'search' => [
        'advanced_link' => 'Avancerad sökning',
        'button' => 'Sök',
        'empty_result' => 'Ingenting hittades!',
        'missing_query' => 'Sökning på nyckelord behöver vara på minst :n karaktärer',
        'title' => 'Sök Resultat',

        'beatmapset' => [
            'more' => ':count fler sök resultat på beatmaps',
            'more_simple' => 'Se fler sök resultat på beatmaps',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alla forum',
            'link' => 'Sök på forumet',
            'more_simple' => 'Se fler sök resultat på forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'sök i forum',
                'forum_children' => 'inkludera subforum',
                'topic_id' => 'ämne #',
                'username' => 'författare',
            ],
        ],

        'mode' => [
            'all' => 'alla',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'spelare',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count fler sök resultat på spelare',
            'more_simple' => 'Se fler sök resultat på spelare',
            'more_hidden' => 'Sökning på spelare är begränsad till :max spelare. Försök förfina sökningen.',
            'title' => 'Spelare',
        ],

        'wiki_page' => [
            'link' => 'Sök på wiki',
            'more_simple' => 'Se fler sök resultat på wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => 'låt oss<br>få dig igång!',
        'action' => 'Ladda ner osu!',
        'os' => [
            'windows' => 'för Windows',
            'macos' => 'för macOS',
            'linux' => 'för Linux',
        ],
        'mirror' => 'spegel',
        'macos-fallback' => 'macOS användare',
        'steps' => [
            'register' => [
                'title' => 'skaffa ett konto',
                'description' => 'följ anvisningarna när du startar spelet för att logga in eller skapa ett nytt konto',
            ],
            'download' => [
                'title' => 'ladda ner spelet',
                'description' => 'klicka på knappen ovan för att ladda ner installeraren, sen kör den!',
            ],
            'beatmaps' => [
                'title' => 'skaffa beatmaps',
                'description' => [
                    '_' => ':browse det stora bibloteket av beatmaps skapade av användare och börja spela!',
                    'browse' => 'bläddra',
                ],
            ],
        ],
        'video-guide' => 'video guide',
    ],

    'user' => [
        'news' => [
            'title' => 'Nyheter',
            'error' => 'Fel med att ladda in nyheter, försök ladda om sidan?...',
        ],
        'header' => [
            'welcome' => 'Hej, <strong>:username</strong>!',
            'messages' => 'Du har 1 nytt meddelande|Du har :count nya meddelanden',
            'stats' => [
                'friends' => 'Vänner Online',
                'games' => 'Spel',
                'online' => 'Användare Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nya Godkända Beatmaps',
            'popular' => 'Populära Beatmaps',
            'by' => 'av',
            'plays' => 'Spelad :count gånger',
        ],
        'buttons' => [
            'download' => 'Ladda ner osu!',
            'support' => 'Stötta osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Det ser ut som att du har det bra! :D',
        'body' => [
            'part-1' => 'Visste du att osu! körs utan annonser, och förlitar sig på spelare som söttar utvecklingen och och kostnader för underhåll?',
            'part-2' => 'Visste du också att när du stöttar osu! så kommer du få en hög med användbara funktioner, som <strong>nedladdning i spelet</strong> vilket automatiskt sätts igång när du är åskådare eller spelar med andra?',
        ],
        'find-out-more' => 'Klicka här för att ta reda på mer!',
        'download-starting' => 'Oh, och oroa dig inte - din nedladdning har redan startas åt dig ;)',
    ],
];
