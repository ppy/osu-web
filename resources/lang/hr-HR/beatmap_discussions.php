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
            'null_user' => '',
            'system_generated' => '',
            'wrong_user' => '',
        ],
    ],

    'events' => [
        'empty' => '',
    ],

    'index' => [
        'deleted_beatmap' => '',
        'none_found' => '',
        'title' => '',

        'form' => [
            '_' => '',
            'deleted' => '',
            'only_unresolved' => '',
            'types' => '',
            'username' => '',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => '',
                'overview' => '',
            ],
        ],
    ],

    'item' => [
        'created_at' => '',
        'deleted_at' => '',
        'message_type' => '',
        'permalink' => '',
    ],

    'nearby_posts' => [
        'confirm' => '',
        'notice' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => '',
            'user' => '',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '',
            'false' => '',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => '',
        'label' => '',
    ],
];
