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
        'online' => '<strong>:players</strong> currently online in <strong>:games</strong> games',
        'peak' => 'Peak, :count online users',
        'players' => '<strong>:count</strong> registered players',

        'download' => [
            '_' => 'Download now',
            'soon' => 'osu! coming soon to other operating systems',
            'for' => 'for :os',
            'other' => 'click here for :os1 or :os2',
        ],

        'slogan' => [
            'main' => 'free-to-play rhythm game',
            'sub' => 'rhythm is just a click away',
        ],
    ],

    'search' => [
        'advanced_link' => 'Advanced search',
        'empty_result' => 'Nothing found!',
        'missing_query' => 'Search keyword of minimum :n characters is required',
        'title' => 'Search Results',

        'beatmapset' => [
            'more' => ':count more beatmap search results',
            'more_simple' => 'See more beatmap search results',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'link' => 'Search the forum',
            'more_simple' => 'See more forum search results',
            'title' => 'Forum',
        ],

        'mode' => [
            'all' => 'all',
            'beatmapset' => 'beatmap',
            'forum_post' => 'forum',
            'user' => 'player',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'more' => ':count more player search results',
            'more_simple' => 'See more player search results',
            'title' => 'Players',
        ],

        'wiki_page' => [
            'link' => 'Search the wiki',
            'more_simple' => 'See more wiki search results',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
      'header' => [
          '1' => "let's get",
          '2' => 'you started',
          '3' => 'download osu! game client for Windows',
      ],
      'steps' => [
          '1' => [
              'name' => 'Step 1',
              'content' => 'Download the osu! game client',
          ],
          '2' => [
              'name' => 'Step 2',
              'content' => 'Create an osu! player account',
          ],
          '3' => [
              'name' => 'Step 3',
              'content' => '???',
          ],
      ],
      'more' => 'Learn more?',
      'more_text' => 'Check out the <a href="https://www.youtube.com/user/osuacademy/">osu!academy YouTube Channel</a> for up-to-date tutorials and tips on how to get the most out of osu!',
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
