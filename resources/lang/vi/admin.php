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

    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Regenerate',
            'regenerating' => 'Regenerating...',
            'remove' => 'Remove',
            'removing' => 'Removing...',
        ],
        'show' => [
            'covers' => 'Manage Beatmapset Covers',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'kích hoạt',
                'activate_confirm' => 'kích hoạt modding v2 cho beatmap này?',
                'active' => 'active',
                'inactive' => 'inactive',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Delete',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'No cover set',

                'submit' => [
                    'save' => 'Save',
                    'update' => 'Update',
                ],

                'title' => 'Forum Covers List',

                'type-title' => [
                    'default-topic' => 'Default Topic Cover',
                    'main' => 'Forum Cover',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Log Viewer',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => 'Admin Console Thingy',

            'sections' => [
                'forum' => 'Forum',
                'general' => 'General',
                'store' => 'Store',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Order Listing',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'This user is currently restricted.',
            'message' => '(only admins can see this)',
        ],
    ],

];
