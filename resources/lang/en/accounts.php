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
    'edit' => [
        'title' => 'Account Settings',
        'title_compact' => 'settings',

        'avatar' => [
            'title' => 'Edit Avatar',
        ],

        'password' => [
            'current' => 'current password',
            'new' => 'new password',
            'new_confirmation' => 'password confirmation',
            'title' => 'Password',
        ],

        'profile' => [
            'title' => 'Edit Profile',

            'user' => [
                'user_from' => 'current location',
                'user_interests' => 'interest',
                'user_msnm' => 'skype',
                'user_occ' => 'occupation',
                'user_twitter' => 'twitter',
                'user_website' => 'website',
            ],
        ],
    ],

    'update_password' => [
        'update' => 'update',
        'updated' => 'Password updated',

        'error' => [
            'missing_parameter' => 'Missing required parameter.',
            'too_short' => 'New password is too short.',
            'username' => 'Password may not contain username',
            'weak' => 'Blacklisted password',
            'wrong_confirmation' => 'Password confirmation does not match.',
            'wrong_current_password' => 'Current password is incorrect.',
        ],
    ],
];
