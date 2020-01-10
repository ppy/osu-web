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
        'download' => 'Last ned nå',
        'online' => '<strong>:players</strong> påkoblet i <strong>:games</strong> spill',
        'peak' => 'Maks, :count påloggede brukere',
        'players' => '<strong>:count</strong> registrerte spillere',
        'title' => 'velkommen',
        'see_more_news' => '',

        'slogan' => [
            'main' => 'det besteste gratis-å-vinne rytmespillet',
            'sub' => 'rytmen er bare et klikk unna',
        ],
    ],

    'search' => [
        'advanced_link' => 'Avansert søk',
        'button' => 'Søk',
        'empty_result' => 'Ingenting funnet!',
        'keyword_required' => 'Et søkeord er nødvendig',
        'placeholder' => 'skriv for å søke',
        'title' => 'Søk',

        'beatmapset' => [
            'more' => ':count flere beatmap-søkeresultater',
            'more_simple' => 'Se flere beatmap-søkeresultater',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alle forum',
            'link' => 'Søk i forumet',
            'more_simple' => 'Se flere forum-søkeresultater',
            'title' => 'Forum',

            'label' => [
                'forum' => 'søk i forumet',
                'forum_children' => 'inkluder underkategorier',
                'topic_id' => 'emne #',
                'username' => 'forfatter',
            ],
        ],

        'mode' => [
            'all' => 'alt',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'spiller',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count flere spiller-søkeresultater',
            'more_simple' => 'Se flere spiller-søkeresultater',
            'more_hidden' => 'Spillersøk er begrenset til :max spillere. Forsøk å raffinere søket.',
            'title' => 'Spillere',
        ],

        'wiki_page' => [
            'link' => 'Søk i wikien',
            'more_simple' => 'Se flere wiki søkeresultater',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "la oss<br>få deg i gang!",
        'action' => 'Last ned osu!',
        'os' => [
            'windows' => 'for Windows',
            'macos' => 'for macOS',
            'linux' => 'for Linux',
        ],
        'mirror' => 'alternativ link',
        'macos-fallback' => 'macOS brukere',
        'steps' => [
            'register' => [
                'title' => 'opprett en konto',
                'description' => 'følg instruksjonene når du starter spillet for å logge inn eller lag en ny konto',
            ],
            'download' => [
                'title' => 'last ned spillet',
                'description' => 'klikk på knappen over for å laste ned installasjonsprogrammet, så kjører det!',
            ],
            'beatmaps' => [
                'title' => 'skaff beatmaps',
                'description' => [
                    '_' => ':browse det enorme biblioteket av brukerskapte beatmaps og begynn å spill!',
                    'browse' => 'bla gjennom',
                ],
            ],
        ],
        'video-guide' => 'video veiledning',
    ],

    'user' => [
        'title' => 'dashbord',
        'news' => [
            'title' => 'Nyheter',
            'error' => 'Feil ved innlasting av nyheter, prøv å oppdatere siden?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Tilkoblede Venner',
                'games' => 'Lobbyer',
                'online' => 'Tilkoblede Brukere',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nye Rangerte Beatmaps',
            'popular' => 'Populære Beatmaps',
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'Last ned osu!',
            'support' => 'Støtt osu!',
            'store' => 'osu!butikken',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Du ser ut som du trives! :D',
        'body' => [
            'part-1' => 'Visste du, at osu! kjører uten reklamering, og er avhengig av spillernes støtte for sin utvikling og driftskostnader?',
            'part-2' => 'Visste du også, at ved å støtte osu! får du en haug med nyttige funksjoner, som for eksempel <strong>nedlasting i spillet</strong> som automatisk laster ned maps mens du ser på andre eller spiller i flerspillerspill?',
        ],
        'find-out-more' => 'Klikk her for å finne ut mer!',
        'download-starting' => "Åh, og ikke bekymre deg - nedlastingen din har allerede begynt :)",
    ],
];
