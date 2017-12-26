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
        'download' => 'Hent nu',
        'online' => '<strong>:players</strong> online i øjeblikket i <strong>:games</strong> spil',
        'peak' => 'Peak, :count online brugere',
        'players' => '<strong>:count</strong> registrerede brugere',

        'slogan' => [
            'main' => 'gratis rytmespil',
            'sub' => 'rytmen er bare ét klik væk',
        ],
    ],

    'search' => [
        'advanced_link' => 'Avanceret søgning',
        'button' => 'Søg',
        'empty_result' => 'Intet fundet!',
        'missing_query' => 'Du skal søge efter nøgleord med mindst :n karakterer!',
        'title' => 'Søgeresultater',

        'beatmapset' => [
            'more' => ':count flere beatmap søgeresultater',
            'more_simple' => 'Se flere beatmap søgeresultater',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alle forums',
            'link' => 'Søg på forummet',
            'more_simple' => 'Se flere forum-søgeresultater',
            'title' => 'Forum',

            'label' => [
                'forum' => 'søg i forummerne',
                'forum_children' => 'inkludér subforums',
                'topic_id' => 'emne #',
                'username' => 'forfatter',
            ],
        ],

        'mode' => [
            'all' => 'all',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'bruger',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count flere spiller-søgeresultater',
            'more_simple' => 'Se flere spiller-søgeresultater',
            'more_hidden' => 'Spillersøgningen er begrænset til højest :max spillere. Prøv at søge igen.',
            'title' => 'Spillere',
        ],

        'wiki_page' => [
            'link' => 'Søg på wiki´et',
            'more_simple' => 'Se flere wiki-søgeresultater',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "lad os få<br>dig i gang!",
        'action' => 'Download osu!',
        'os' => [
            'windows' => 'til Windows',
            'macos' => 'til macOS',
            'linux' => 'til Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'macOS brugere',
        'steps' => [
            'register' => [
                'title' => 'opret en bruger',
                'description' => 'følg instrukserne når spillet startes for at logge ind eller lave en ny konto',
            ],
            'download' => [
                'title' => 'hent spillet',
                'description' => 'klik på knappen ovenfor for at hente installeren, og kør den!',
            ],
            'beatmaps' => [
                'title' => 'anskaf beatmaps',
                'description' => [
                    '_' => ':browse det gigantiske bibliotek af bruger-oprettede beatmaps, og begynd at spille!',
                    'browse' => 'gennemse',
                ],
            ],
        ],
        'video-guide' => 'video-guide',
    ],

    'user' => [
        'title' => 'nyheder',
        'news' => [
            'title' => 'Nyheder',
            'error' => 'Fejl ved indlæsning af nyheder, prøv at genindlæse siden?...',
        ],
        'header' => [
            'welcome' => 'Hejsa, <strong>:username</strong>!',
            'messages' => 'Du har 1 ny besked|Du har :count nye beskeder',
            'stats' => [
                'friends' => 'Online venner',
                'games' => 'Spil',
                'online' => 'Online brugere',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nye Godkendte Beatmaps',
            'popular' => 'Populære Beatmaps',
            'by' => 'af',
            'plays' => ':count afspilninger',
        ],
        'buttons' => [
            'download' => 'Hent osu!',
            'support' => 'Støt osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Du ser ud til at have det sjovt! :D',
        'body' => [
            'part-1' => 'Vidste du, at osu! kører helt uden reklamer og er stærkt afhængigt af, at spillerne støtter spillets udvikling og omkostninger?',
            'part-2' => 'Vidste du også, at du ved at støtte osu! får en stor håndfuld ekstra brugbare funktioner, såsom <strong>in-game downloading</strong> som kan udnyttes i multiplayer- og tilskuertilstand?',
        ],
        'find-out-more' => 'Klik her for at læse mere!',
        'download-starting' => "Hov, og bare rolig - din download er allerede startet for dig ;)",
    ],
];
