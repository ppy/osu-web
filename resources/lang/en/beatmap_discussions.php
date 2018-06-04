<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'types' => 'Message types',
            'username' => 'Username',

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

    'user' => [
        'admin' => 'admin',
        'bng' => 'nominator',
        'owner' => 'mapper',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'Everyone',
        'label' => 'Filter by user',
    ],
];
