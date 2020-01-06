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
        'download' => 'Ladda ner nu',
        'online' => '<strong>:players</strong> spelare online i <strong>:games</strong> spel',
        'peak' => 'Som högst, :count spelare online',
        'players' => '<strong>:count</strong> registrerade spelare',
        'title' => 'välkommen',
        'see_more_news' => 'se fler nyheter',

        'slogan' => [
            'main' => 'gratis-att-spela rytm spel',
            'sub' => 'rytmen är bara ett klick bort',
        ],
    ],

    'search' => [
        'advanced_link' => 'Avancerad sökning',
        'button' => 'Sök',
        'empty_result' => 'Ingenting hittades!',
        'keyword_required' => 'Ett sökord krävs',
        'placeholder' => 'skriv för att söka',
        'title' => 'Sök',

        'beatmapset' => [
            'more' => ':count fler sökresultat på beatmaps',
            'more_simple' => 'Se fler sökresultat på beatmaps',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alla forum',
            'link' => 'Sök på forumet',
            'more_simple' => 'Se fler sökresultat på forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'sök i forumen',
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
            'more' => ':count fler sökresultat på spelare',
            'more_simple' => 'Se fler sökresultat på spelare',
            'more_hidden' => 'Sökning på spelare är begränsad till :max spelare. Försök att förfina sökningen.',
            'title' => 'Spelare',
        ],

        'wiki_page' => [
            'link' => 'Sök på wikin',
            'more_simple' => 'Se fler sökresultat på wikin',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "låt oss<br>få dig igång!",
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
                'description' => 'klicka på knappen ovan för att ladda ner installeraren, sedan kör du den!',
            ],
            'beatmaps' => [
                'title' => 'skaffa beatmaps',
                'description' => [
                    '_' => ':browse i det stora bibloteket av beatmaps skapade av användare och börja spela!',
                    'browse' => 'bläddra',
                ],
            ],
        ],
        'video-guide' => 'video guide',
    ],

    'user' => [
        'title' => 'kontrollpanel',
        'news' => [
            'title' => 'Nyheter',
            'error' => 'Fel med att ladda in nyheter, försök ladda om sidan?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Vänner Online',
                'games' => 'Spel',
                'online' => 'Användare Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nya Rankade Beatmaps',
            'popular' => 'Populära Beatmaps',
            'by_user' => 'av :user',
        ],
        'buttons' => [
            'download' => 'Ladda ner osu!',
            'support' => 'Stötta osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Det ser ut som att du har kul! :D',
        'body' => [
            'part-1' => 'Visste du att osu! körs utan annonser, och förlitar sig på spelare som stöttar utvecklingen och kostnader för underhåll?',
            'part-2' => 'Visste du också att när du stöttar osu! så kommer du få en hög med användbara funktioner, som <strong>nedladdning i spelet</strong> vilket automatiskt sätts igång när du är åskådare eller spelar med andra?',
        ],
        'find-out-more' => 'Klicka här för att ta reda på mer!',
        'download-starting' => "Åh, och oroa dig inte - din nedladdning har redan startas åt dig ;)",
    ],
];
