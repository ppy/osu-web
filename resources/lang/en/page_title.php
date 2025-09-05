<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
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
        'topic_logs_controller' => [
            'index' => 'topic logs',
        ],
    ],
    'main' => [
        'account_controller' => [
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
        'contest_entries_controller' => [
            'judge_results' => 'contest judging results',
        ],
        'contests_controller' => [
            '_' => 'contests',
            'judge' => 'contest judging',
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
        'legacy_matches_controller' => [
            '_' => 'matches',
        ],
        'legal_controller' => [
            '_' => 'information',
        ],
        'livestreams_controller' => [
            '_' => 'live streams',
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
        'seasons_controller' => [
            '_' => 'rankings',
        ],
        'teams_controller' => [
            '_' => 'teams',
            'create' => 'create team',
            'edit' => 'team settings',
            'leaderboard' => 'team leaderboard',
            'show' => 'team info',
        ],
        'tournaments_controller' => [
            '_' => 'tournaments',
        ],
        'user_cover_presets_controller' => [
            '_' => 'user cover presets',
        ],
        'user_totp_controller' => [
            '_' => 'authenticator app',
        ],
        'users_controller' => [
            '_' => 'player info',
            'create' => 'create account',
            'disabled' => 'notice',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => 'room history',
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
    'teams' => [
        'members_controller' => [
            'index' => 'team members',
        ],
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
