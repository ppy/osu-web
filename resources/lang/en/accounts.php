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
    'edit' => [
        'title' => '<strong>Account</strong> Settings',
        'title_compact' => 'settings',
        'username' => 'username',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'current email',
            'new' => 'new email',
            'new_confirmation' => 'email confirmation',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'current password',
            'new' => 'new password',
            'new_confirmation' => 'password confirmation',
            'title' => 'Password',
        ],

        'profile' => [
            'title' => 'Profile',

            'user' => [
                'user_from' => 'current location',
                'user_interests' => 'interests',
                'user_msnm' => 'skype',
                'user_occ' => 'occupation',
                'user_twitter' => 'twitter',
                'user_website' => 'website',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Signature',
            'update' => 'update',
        ],
    ],

    'update_email' => [
        'email_subject' => 'osu! email change confirmation',
        'update' => 'update',
    ],

    'update_password' => [
        'email_subject' => 'osu! password change confirmation',
        'update' => 'update',
    ],

    'playstyles' => [
        'title' => 'Playstyles',
        'mouse' => 'mouse',
        'keyboard' => 'keyboard',
        'tablet' => 'tablet',
        'touch' => 'touch',
    ],

    'privacy' => [
        'title' => 'Privacy',
        'friends_only' => 'block private messages from people not on your friends list',
    ],

    'security' => [
        'current_session' => 'current',
        'end_session' => 'End Session',
        'end_session_confirmation' => 'This will immedietely end your session on that device. Are you sure?',
        'last_active' => 'Last active:',
        'title' => 'Security',
        'web_sessions' => 'web sessions',
    ],
];
