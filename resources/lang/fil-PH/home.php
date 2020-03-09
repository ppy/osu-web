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
        'download' => 'I-download na',
        'online' => '<strong>:players</strong> kasalukuyang online sa <strong>:games</strong> laro',
        'peak' => '',
        'players' => '<strong>:count</strong> na rehistradong mga manlalaro',
        'title' => 'maligayang pag dating',
        'see_more_news' => '',

        'slogan' => [
            'main' => '',
            'sub' => '',
        ],
    ],

    'search' => [
        'advanced_link' => 'Detalyadong paghanap',
        'button' => 'Hanapin',
        'empty_result' => 'Walang makita!',
        'keyword_required' => '',
        'placeholder' => 'mag-type para makapag-search',
        'title' => 'Hanapin',

        'beatmapset' => [
            'login_required' => '',
            'more' => ':count pang resulta ng beatmap search',
            'more_simple' => '',
            'title' => 'Mga Beatmap',
        ],

        'forum_post' => [
            'all' => 'Lahat ng mga forum',
            'link' => 'Hanapin ang paksang ito',
            'login_required' => '',
            'more_simple' => '',
            'title' => 'Forum',

            'label' => [
                'forum' => 'hanapin ang paksang ito',
                'forum_children' => 'isama ang mga subforum',
                'topic_id' => 'paksa #',
                'username' => 'may-akda',
            ],
        ],

        'mode' => [
            'all' => 'lahat',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'manlalaro',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => '',
            'more' => '',
            'more_simple' => '',
            'more_hidden' => '',
            'title' => 'Mga Manlalaro',
        ],

        'wiki_page' => [
            'link' => 'Hanapin sa wiki',
            'more_simple' => '',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "tayo nang<br>simulan ito!",
        'action' => 'I-download ang osu!',
        'os' => [
            'windows' => 'para sa Windows',
            'macos' => 'para sa macOS',
            'linux' => 'para sa Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'mga gumagamit ng macOS',
        'steps' => [
            'register' => [
                'title' => 'gumawa ng account',
                'description' => '',
            ],
            'download' => [
                'title' => 'i-download ang laro',
                'description' => 'i-click ang button sa itaas upang i-download ang installer, pagkatapos ay itakbo ito!',
            ],
            'beatmaps' => [
                'title' => 'kumuha ng mga beatmap',
                'description' => [
                    '_' => ':browse ang malawak na librerya ng mga beatmap na ginawa ng mga tao at simulan ang laro!',
                    'browse' => 'tingnan',
                ],
            ],
        ],
        'video-guide' => '',
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'Balita',
            'error' => 'Nagkaproblema sa pag-load ng mga balita, subukang i-refresh ang pahina?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Mga Online na Kaibigan',
                'games' => 'Mga Laro',
                'online' => 'Ang mga online na user',
            ],
        ],
        'beatmaps' => [
            'new' => 'Mga bagong na-rank na Beatmap',
            'popular' => 'Popular na mga Beatmap',
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'I-download ang osu!',
            'support' => 'Suportahan ang osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Mukhang nag e-enjoy ka! :D',
        'body' => [
            'part-1' => '',
            'part-2' => '',
        ],
        'find-out-more' => 'I-click ito para mas malaman pa!',
        'download-starting' => "Wag mag alala - nagsisimula na ang iyong download ;)",
    ],
];
