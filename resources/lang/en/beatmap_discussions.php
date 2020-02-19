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
        'none_found' => 'No discussions matching that search criteria were found.',
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

    'review' => [
        'go_to_parent' => 'View Review Post',
        'go_to_child' => 'View Discussion',
        'validation' => [
            'invalid_block_type' => 'invalid block type',
            'invalid_document' => 'invalid review',
            'minimum_issues' => 'review must contain a minimum of :count issue|review must contain a minimum of :count issues',
            'missing_text' => 'block is missing text',
            'too_many_blocks' => 'reviews may only contain :count paragraph/issue|reviews may only contain up to :count paragraphs/issues',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marked as resolved by :user',
            'false' => 'Reopened by :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'general',
        'general_all' => 'general (all)',
    ],

    'user_filter' => [
        'everyone' => 'Everyone',
        'label' => 'Filter by user',
    ],
];
