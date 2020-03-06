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
    'edit' => [
        'title_compact' => 'postavke',
        'username' => 'korisničko ime',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => '',
            'rules_link' => '',
        ],

        'email' => [
            'current' => 'trenutna e-mail adresa',
            'new' => 'nova e-mail adresa',
            'new_confirmation' => 'potvrda e-mail adrese',
            'title' => 'E-mail adresa',
        ],

        'password' => [
            'current' => 'trenutna lozinka',
            'new' => 'nova lozinka',
            'new_confirmation' => 'potvrda lozinke',
            'title' => 'Lozinka',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'trenutna lokacija',
                'user_interests' => 'interesi',
                'user_msnm' => '',
                'user_occ' => 'zanimanje',
                'user_twitter' => '',
                'user_website' => 'web stranica',
            ],
        ],

        'signature' => [
            'title' => 'Potpis',
            'update' => 'ažuriraj',
        ],
    ],

    'notifications' => [
        'title' => '',
        'topic_auto_subscribe' => '',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '',
        'own_clients' => '',
        'title' => '',
    ],

    'playstyles' => [
        'keyboard' => 'tipkovnica',
        'mouse' => 'miš',
        'tablet' => 'tablet',
        'title' => 'Način igranja',
        'touch' => 'dodir',
    ],

    'privacy' => [
        'friends_only' => '',
        'hide_online' => '',
        'title' => '',
    ],

    'security' => [
        'current_session' => '',
        'end_session' => '',
        'end_session_confirmation' => '',
        'last_active' => '',
        'title' => '',
        'web_sessions' => '',
    ],

    'update_email' => [
        'update' => 'ažuriraj',
    ],

    'update_password' => [
        'update' => 'ažuriraj',
    ],

    'verification_completed' => [
        'text' => '',
        'title' => '',
    ],

    'verification_invalid' => [
        'title' => '',
    ],
];
