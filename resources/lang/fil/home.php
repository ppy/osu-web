<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'I-download na',
        'online' => '<strong>:players</strong> kasalukuyang online sa <strong>:games</strong> laro',
        'peak' => 'Pinakamarami, :count na mga manlalarong online',
        'players' => '<strong>:count</strong> na rehistradong mga manlalaro',
        'title' => 'maligayang pag dating',
        'see_more_news' => 'higit pang mga balita',

        'slogan' => [
            'main' => 'ang pinaka-pinakanangungunang libre-para-panalunin na larong pangritmo',
            'sub' => 'ang ritmo ay isang click nalang',
        ],
    ],

    'search' => [
        'advanced_link' => 'Detalyadong paghanap',
        'button' => 'Hanapin',
        'empty_result' => 'Walang makita!',
        'keyword_required' => 'Ang hinahanap na keyword ay kailangan',
        'placeholder' => 'mag-type para makapag-search',
        'title' => 'Hanapin',

        'beatmapset' => [
            'login_required' => 'Mag sign-in para maka-search ng beatmaps',
            'more' => ':count pang resulta ng beatmap search',
            'more_simple' => 'Tignan ang iba pang resulta ng beatmap',
            'title' => 'Mga Beatmap',
        ],

        'forum_post' => [
            'all' => 'Lahat ng mga forum',
            'link' => 'Hanapin ang paksang ito',
            'login_required' => 'Mag sign-in para maka-search sa forum',
            'more_simple' => 'Higit pang mga resulta sa paghahanap sa forum',
            'title' => 'Forum',

            'label' => [
                'forum' => 'hanapin ang paksang ito',
                'forum_children' => 'isama ang mga subforum',
                'include_deleted' => 'Isama ang mga tinanggal na mga post',
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
            'login_required' => 'Mag sign-in para maka-search ng mga users',
            'more' => ':count pang mga manlalaro sa resulta ng paghahanap',
            'more_simple' => 'Higit pang mga manlalaro sa resulta ng paghahanap',
            'more_hidden' => 'Nakalimita sa :max lamang ang resulta sa paghahanap ng mga manlalaro. Subukang dagdagan pa ang pagsasala ng paghahanap.',
            'title' => 'Mga Manlalaro',
        ],

        'wiki_page' => [
            'link' => 'Hanapin sa wiki',
            'more_simple' => 'Higit pang mga resulta sa paghahanap sa wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'action' => 'I-download ang osu!',
        'action_lazer' => 'I-download ang osu!(lazer)',
        'action_lazer_description' => 'ang susunod na major update sa osu!',
        'action_lazer_info' => 'tingnan ang pahinang ito para sa karagdagang impormasyon',
        'action_lazer_title' => 'subukan ang osu!(lazer)',
        'action_title' => 'i-download ang osu!
',
        'for_os' => 'para sa :os',
        'lazer_note' => 'tandaan: ang mga pag-reset ng leaderboard ay nalalapat',
        'macos-fallback' => 'mga gumagamit ng macOS',
        'mirror' => 'mirror',
        'or' => 'o',
        'os_version_or_later' => '',
        'other_os' => 'iba pang mga platform',
        'quick_start_guide' => 'gabay sa mabilis na pagsisimula',
        'tagline' => "tayo nang<br>simulan ito!",
        'video-guide' => 'video na panggabay',

        'help' => [
            '_' => 'kung may problema ka sa pagbukas ng laro o sa paggawa ng account, :help_forum_link o :support_button.',
            'help_forum_link' => 'subukan ang help forum',
            'support_button' => 'makipag-ugnay sa support',
        ],

        'os' => [
            'windows' => 'para sa Windows',
            'macos' => 'para sa macOS',
            'linux' => 'para sa Linux',
        ],
        'steps' => [
            'register' => [
                'title' => 'gumawa ng account',
                'description' => 'sundan ang mga senyas habang binubuksan ang laro upang makasign-in o makagawa ng bagong account',
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
            'by_user' => 'ni :user',
        ],
        'buttons' => [
            'download' => 'I-download ang osu!',
            'support' => 'Suportahan ang osu!',
            'store' => 'osu!store',
        ],
    ],
];
