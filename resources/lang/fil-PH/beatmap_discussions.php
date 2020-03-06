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
            'null_user' => 'Dapat ay naka-sign-in para mag-edit.',
            'system_generated' => 'Hindi pwedeng i-edit ang post na ginawa ng sistema.',
            'wrong_user' => 'Dapat ay may-ari ng post para i-edit.',
        ],
    ],

    'events' => [
        'empty' => 'Walang nangyari... pa.',
    ],

    'index' => [
        'deleted_beatmap' => 'tinanggal',
        'none_found' => '',
        'title' => 'Talakayan ng Beatmap',

        'form' => [
            '_' => 'Search',
            'deleted' => 'Isama ang mga tinanggal na talakayan',
            'only_unresolved' => '',
            'types' => 'Mga uri ng mensahe',
            'username' => 'Username',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'User',
                'overview' => 'Pangkalahatang aktibidad',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Petsa ng post',
        'deleted_at' => 'Petsa ng pagkakaalis',
        'message_type' => 'Uri',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Wala sa mga post ang nakatulong sa aking tungkulin',
        'notice' => 'Mayroong mga post noong humigit-kumulang :timestamp (:existing_timestamps). Mangyaring suriin ang mga ito bago mag-post.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Mag-sign in upang maka-sagot',
            'user' => 'Tumugon',
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
            'true' => 'Minarkahang resolbado ni :user',
            'false' => 'Muling binuksan ni :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Lahat',
        'label' => 'I-filter sa user',
    ],
];
