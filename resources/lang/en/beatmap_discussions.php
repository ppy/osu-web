<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Must be signed in to edit.',
            'system_generated' => 'System-generated post can not be edited.',
            'wrong_user' => 'Must be owner of the post to edit.',
        ],
    ],

    'events' => [
        'empty' => 'Nothing has happened... yet.',
    ],

    'index' => [
        'deleted_beatmap' => 'deleted',
        'title' => 'Beatmap Discussions',

        'form' => [
            '_' => 'Search',
            'deleted' => 'Include deleted discussions',
            'only_unresolved' => 'Show only unresolved discussions',
            'types' => 'Message types',
            'username' => 'Username',

            'beatmapset_status' => [
                '_' => 'Beatmap Status',
                'all' => 'All',
                'disqualified' => 'Disqualified',
                'never_qualified' => 'Never Qualified',
                'qualified' => 'Qualified',
                'ranked' => 'Ranked',
            ],

            'user' => [
                'label' => 'User',
                'overview' => 'Activities overview',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Post date',
        'deleted_at' => 'Deletion date',
        'message_type' => 'Type',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'None of the posts address my concern',
        'notice' => 'There are posts around :timestamp (:existing_timestamps). Please check them before posting.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Sign in to Respond',
            'user' => 'Respond',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marked as resolved by :user',
            'false' => 'Reopened by :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Everyone',
        'label' => 'Filter by user',
    ],
];
