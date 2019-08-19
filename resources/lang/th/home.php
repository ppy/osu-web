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
        'download' => 'ดาวน์โหลดเลย',
        'online' => '<strong>:players</strong> currently online in <strong>:games</strong> games',
        'peak' => 'Peak, :count online users',
        'players' => '<strong>:count</strong> registered players',
        'title' => 'ยินดีต้อนรับ',

        'slogan' => [
            'main' => 'the bestest free-to-win rhythm game',
            'sub' => 'rhythm is just a click away',
        ],
    ],

    'search' => [
        'advanced_link' => 'การค้นหาขั้นสูง',
        'button' => 'ค้นหา',
        'empty_result' => 'ไม่พบสิ่งใด!',
        'keyword_required' => 'ต้องการค้นหาคำหลัก',
        'placeholder' => 'type to search',
        'title' => 'ค้นหา',

        'beatmapset' => [
            'more' => ':count more beatmap search results',
            'more_simple' => 'ดูผลการค้นหาบีทแมพเพิ่มเติม',
            'title' => 'บีทแมพ',
        ],

        'forum_post' => [
            'all' => 'ฟอรั่มทั้งหมด',
            'link' => 'Search the forum',
            'more_simple' => 'See more forum search results',
            'title' => 'Forum',

            'label' => [
                'forum' => 'search in forums',
                'forum_children' => 'include subforums',
                'topic_id' => 'หัวข้อ #',
                'username' => 'ผู้สร้าง',
            ],
        ],

        'mode' => [
            'all' => 'ทั้งหมด',
            'beatmapset' => 'บีทแมพ',
            'forum_post' => 'ฟอรั่ม',
            'user' => 'ผู้เล่น',
            'wiki_page' => 'วิกิ',
        ],

        'user' => [
            'more' => ':count more player search results',
            'more_simple' => 'See more player search results',
            'more_hidden' => 'Player search is limited to :max players. Try refining search query.',
            'title' => 'ผู้เล่น',
        ],

        'wiki_page' => [
            'link' => 'Search the wiki',
            'more_simple' => 'See more wiki search results',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "let's get<br>you started!",
        'action' => 'Download osu!',
        'os' => [
            'windows' => 'สำหรับ Windows',
            'macos' => 'สำหรับ macOS',
            'linux' => 'สำหรับ Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'macOS users',
        'steps' => [
            'register' => [
                'title' => 'get an account',
                'description' => 'follow the prompts when starting the game to sign in or make a new account',
            ],
            'download' => [
                'title' => 'download the game',
                'description' => 'click the button above to download the installer, then run it!',
            ],
            'beatmaps' => [
                'title' => 'get beatmaps',
                'description' => [
                    '_' => ':browse the vast library of user-created beatmaps and start playing!',
                    'browse' => 'browse',
                ],
            ],
        ],
        'video-guide' => 'video guide',
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'ข่าวสาร',
            'error' => 'Error loading news, try refreshing the page?...',
        ],
        'header' => [
            'welcome' => 'Hello, <strong>:username</strong>!',
            'messages' => 'คุณมี :count ข้อความใหม่|คุณมี :count ข้อความใหม่',
            'stats' => [
                'friends' => 'จำนวนเพื่อนที่ออนไลน์',
                'games' => 'Games',
                'online' => 'จำนวนผู้ใช้ที่ออนไลน์',
            ],
        ],
        'beatmaps' => [
            'new' => 'Ranked Beatmaps อันใหม่',
            'popular' => 'บีทแมพที่นิยม',
            'by' => 'โดย',
            'plays' => ':count plays',
        ],
        'buttons' => [
            'download' => 'Download osu!',
            'support' => 'Support osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'ว้าว!',
        'subtitle' => 'You seem to be having a good time! :D',
        'body' => [
            'part-1' => 'Did you know that osu! runs with no advertising, and relies on players to support its development and running costs?',
            'part-2' => 'Did you also know that by supporting osu! you get a heap of useful features, such as <strong>in-game downloading</strong> which automatically triggers in spectator and multiplayer games?',
        ],
        'find-out-more' => 'Click here to find out more!',
        'download-starting' => "Oh, and don't worry - your download has already been started for you already ;)",
    ],
];
