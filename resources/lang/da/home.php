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
        'online' => '<strong>:players</strong> er online i øjeblikket i <strong>:games</strong> spil',
        'peak' => 'Toppunkt: :count',
        'players' => '<strong>:count</strong> registrerede spillere',

        'download' => [
            '_' => 'Download now',
            'soon' => 'osu! kommer snart til flere operativsystemer',
            'for' => 'til :os',
            'other' => 'klik her for :os1 eller :os2',
        ],

        'slogan' => [
            'main' => 'Gratis rytme-spil',
            'sub' => 'rytmen er bare ét klik væk',
        ],
    ],

    'search' => [
        'advanced_link' => 'Avanceret søgning',
        'button' => 'Søg',
        'empty_result' => 'Intet fundet!',
        'missing_query' => 'Søg nøgleord med mindst :n karakterer er nødvendigt',
        'title' => 'Søg resultater',

        'beatmapset' => [
            'more' => ':count flere beatmap søgeresultater',
            'more_simple' => 'Se flere beatmap søgeresultater',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Alle forums',
            'link' => 'Søg på forummet',
            'more_simple' => 'Se flere søgeresultater fra forummet',
            'title' => 'Forum',

            'label' => [
                'forum' => 'Søg i forums',
                'forum_children' => 'inkluder subforums',
                'topic_id' => 'emne #',
                'username' => 'forfatter',
            ],
        ],

        'mode' => [
            'all' => 'alle',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'spiller',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count flere spiller søgeresultater',
            'more_simple' => 'Se flere spiller søgeresultater',
            'more_hidden' => 'Spillersøgningen er begrænset til :max spillere. Prøv at lave om på din søgning.',
            'title' => 'Spillere',
        ],

        'wiki_page' => [
            'link' => 'Søg på wikiet',
            'more_simple' => 'Se flere wiki resultater',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
      'header' => [
          '1' => 'lad os få',
          '2' => 'dig i gang',
          '3' => 'download osu! spilklienten til Windows',
      ],
      'steps' => [
          '1' => [
              'name' => 'Trin 1',
              'content' => 'Download osu! spilklienten',
          ],
          '2' => [
              'name' => 'Trin 2',
              'content' => 'Lav en osu! spillerkonto',
          ],
          '3' => [
              'name' => 'Trin 3',
              'content' => '???',
          ],
      ],
      'more' => 'Vil du lære mere?',
      'more_text' => 'Tjek <a href="https://www.youtube.com/user/osuacademy/">osu!academy YouTube Kanalen</a> for at få god vejledning til, hvordan du får den bedste oplevelse ud af osu!',
    ],

    'user' => [
        'title' => 'nyheder',
        'news' => [
            'title' => 'Nyheder',
            'error' => 'Fejl under indlæsning af nyheder. Prøv at genindlæse siden...',
        ],
        'header' => [
            'welcome' => 'Hejsa, <strong>:username</strong>!',
            'messages' => 'Du har 1 ny besked|Du har :count nye beskeder',
            'stats' => [
                'friends' => 'Online Venner',
                'games' => 'Spil',
                'online' => 'Online Brugere',
            ],
        ],
        'beatmaps' => [
            'new' => 'Nye Godkendte Beatmaps',
            'popular' => 'Populære Beatmaps',
            'by' => 'af',
            'plays' => ':count afspilninger',
        ],
        'buttons' => [
            'download' => 'Download osu!',
            'support' => 'Støt osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Du ser ud til at have det sjovt! :D',
        'body' => [
            'part-1' => 'Vidste du, at osu! er drevet helt uden reklamer og er afhængigt af, at spillets aktive brugere støtter udvikling og vedligeholdelsen?',
            'part-2' => 'Vidste du også, at du ved at støtte osu! får en masse lækre funktioner, som f.eks. <strong>downloads i spillet</strong> som automatisk foregår, når du ser på et spil eller spiller et multiplayerspil?',
        ],
        'find-out-more' => 'Klik her for at læse mere',
        'download-starting' => 'Hov, og bare rolig - din download er allerede sat i gang for dig ;)',
    ],
];
