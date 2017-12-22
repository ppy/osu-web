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
    'authorizations' => [
        'update' => [
            'null_user' => 'Bạn cần phải đăng nhập để chỉnh sửa.',
            'system_generated' => 'System-generated post can not be edited.',
            'wrong_user' => 'Must be owner of the post to edit.',
        ],
    ],

    'events' => [
        'empty' => 'Nothing has happened... yet.',
    ],

    'nearby_posts' => [
        'confirm' => 'None of the posts address my concern',
        'notice' => 'There are posts around :timestamp (:existing_timestamps). Please check them before posting.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Login to Respond',
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
];
