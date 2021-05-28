<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
            'mode' => 'Beatmap mode',
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
        'unsaved' => ':count in this review',
    ],

    'owner_editor' => [
        'button' => 'Difficulty Owner',
        'reset_confirm' => 'Reset owner for this difficulty?',
        'user' => 'Owner',
        'version' => 'Difficulty',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Sign in to Respond',
            'user' => 'Respond',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocks used',
        'go_to_parent' => 'View Review Post',
        'go_to_child' => 'View Discussion',
        'validation' => [
            'block_too_large' => 'each block may only contain up to :limit characters',
            'external_references' => 'review contains references to issues that don\'t belong to this review',
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
