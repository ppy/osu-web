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
        'slogans' => [
            '1' => 'free-to-win<br/>circle simulator',
            '2' => 'rhythm is just<br/> a click away',
        ],

        'download' => [
            '_' => 'Download now',
            'for' => 'for :os',
            'other' => 'click here for :os1 or :os2',
        ],

        'players' => '<strong>:count</strong> registered players',
        'online' => '<strong>:players</strong> currently online in <strong>:games</strong> games',
        'peak' => 'Peak, :count online users',
    ],
    'user' => [
        'title' => 'news',
        'news' => [
            'title' => 'News',
            'error' => 'Error loading news, try refreshing the page?...',
        ],
        'header' => [
            'welcome' => 'Hello, <strong>:username</strong>!',
            'messages' => 'You have 1 new message|You have :count new messages',
            'stats' => [
                'online' => 'Online Users',
            ],
        ],
        'beatmaps' => [
            'new' => 'New Approved Beatmaps',
            'popular' => 'Popular Beatmaps',
        ],
        'buttons' => [
            'download' => 'Download osu!',
            'support' => 'Support osu!',
            'store' => 'osu!store',
        ],
    ],
];
