<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => 'admin',
    ],
    'admin_forum' => [
        '_' => 'admin',
    ],
    'admin_store' => [
        '_' => 'admin',
    ],
    'error' => [
        'error' => [
            '400' => 'invalid request',
            '404' => 'missing',
            '403' => 'forbidden',
            '401' => 'unauthorized',
            '401-verification' => 'account verification',
            '405' => 'missing',
            '422' => 'invalid request',
            '429' => 'too many requests',
            '500' => 'something broke',
            '503' => 'maintenance',
        ],
    ],
    'forum' => [
        '_' => 'forum',
        'topic_watches_controller' => [
            'index' => 'dashboard',
        ],
    ],
    'main' => [
        'account_controller' => [
            'edit' => 'dashboard',
            'verify_link' => 'account verification',
        ],
        'artists_controller' => [
            '_' => 'featured artists',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'beatmap discussion posts',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'beatmap discussions',
        ],
        'beatmap_packs_controller' => [
            '_' => 'beatmap packs',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'beatmap discussion votes',
        ],
        'beatmapset_events_controller' => [
            '_' => 'beatmap history',
        ],
        'beatmapset_watches_controller' => [
            'index' => 'dashboard',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'beatmap discussion',
            'index' => 'beatmap listing',
            'show' => 'beatmap info',
        ],
        'changelog_controller' => [
            '_' => 'changelog',
        ],
        'chat_controller' => [
            '_' => 'chat',
        ],
        'comments_controller' => [
            '_' => 'comments',
        ],
        'contests_controller' => [
            '_' => 'contests',
        ],
        'follows_controller' => [
            'index' => 'dashboard',
        ],
        'friends_controller' => [
            'index' => 'dashboard',
        ],
        'groups_controller' => [
            'show' => 'groups',
        ],
        'home_controller' => [
            'get_download' => 'download',
            'index' => 'dashboard',
            'search' => 'search',
            'support_the_game' => 'support the game',
            'testflight' => 'testflight',
        ],
        'legal_controller' => [
            '_' => 'information',
        ],
        'livestreams_controller' => [
            '_' => 'live streams',
        ],
        'matches_controller' => [
            '_' => 'matches',
        ],
        'news_controller' => [
            '_' => 'news',
        ],
        'notifications_controller' => [
            '_' => 'notifications history',
        ],
        'password_reset_controller' => [
            '_' => 'password reset',
        ],
        'ranking_controller' => [
            '_' => 'rankings',
        ],
        'scores_controller' => [
            '_' => 'performance',
        ],
        'store_controller' => [
            '_' => 'store',
        ],
        'tournaments_controller' => [
            '_' => 'tournaments',
        ],
        'users_controller' => [
            '_' => 'player info',
            'disabled' => 'notice',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            '_' => 'rankings',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'authorize app',
        ],
    ],
    'store' => [
        '_' => 'store',
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'modder info',
        ],
        'multiplayer_controller' => [
            '_' => 'multiplayer history',
        ],
    ],
];
