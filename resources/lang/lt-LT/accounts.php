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
        'title_compact' => 'nustatymai',
        'username' => 'slapyvardis',

        'avatar' => [
            'title' => 'Avataras',
            'rules' => '',
            'rules_link' => 'bendruomenės taisykles',
        ],

        'email' => [
            'current' => 'dabartinis el. paštas',
            'new' => 'naujas el. paštas',
            'new_confirmation' => 'el. pašto patvirtinimas',
            'title' => 'El. Paštas',
        ],

        'password' => [
            'current' => 'dabartinis slaptažodis',
            'new' => 'naujas slaptažodis',
            'new_confirmation' => 'slaptažodžio patvirtinimas',
            'title' => 'Slaptažodis',
        ],

        'profile' => [
            'title' => 'Profilis',

            'user' => [
                'user_discord' => '',
                'user_from' => 'dabartinė vieta',
                'user_interests' => 'pomėgiai',
                'user_msnm' => '',
                'user_occ' => 'profesija',
                'user_twitter' => '',
                'user_website' => 'tinklalapis',
            ],
        ],

        'signature' => [
            'title' => 'Parašas',
            'update' => 'užsaugoti',
        ],
    ],

    'notifications' => [
        'title' => 'Pranešimai',
        'topic_auto_subscribe' => 'automatiškai įjungti pranešimus naujuose forumo temose kurias tu sukūrei',
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
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'klaviatūra',
        'mouse' => 'pelė',
        'tablet' => 'grafinė planšetė',
        'title' => 'Žaidimo stilius',
        'touch' => 'liečiamas ekranas',
    ],

    'privacy' => [
        'friends_only' => 'blokuoti privačias žinutes iš žmonių kurių nėra draugų sąraše',
        'hide_online' => 'paslėpti jūsų prisijungimo sesiją',
        'title' => 'Privatumas',
    ],

    'security' => [
        'current_session' => 'šiuo metu',
        'end_session' => 'Užbaigti seansą',
        'end_session_confirmation' => 'Taip labai greitai užbaigsite seansą toje įrenginyje. Ar jūs tuom tikrai įsitikinę?',
        'last_active' => 'Paskutinis aktyvumas:',
        'title' => 'Apsauga',
        'web_sessions' => 'tinklalapio sesijos',
    ],

    'update_email' => [
        'update' => 'užsaugoti',
    ],

    'update_password' => [
        'update' => 'užsaugoti',
    ],

    'verification_completed' => [
        'text' => 'Galite uždaryti šį skirtumą/langą dabar',
        'title' => 'Patvirtinimas baigtas',
    ],

    'verification_invalid' => [
        'title' => 'Netinkama arba pasibaigusi nuoroda',
    ],
];
