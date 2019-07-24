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
        'title' => '<strong>Konto</strong> Inställningar',
        'title_compact' => 'inställningar',
        'username' => 'användarnamn',

        'avatar' => [
            'title' => 'Profilbild',
        ],

        'email' => [
            'current' => 'nuvarande e-postadress',
            'new' => 'ny e-postadress',
            'new_confirmation' => 'email bekräftelse',
            'title' => 'E-postadress',
        ],

        'password' => [
            'current' => 'nuvarande lösenord',
            'new' => 'nytt lösenord',
            'new_confirmation' => 'lösenordsbekräftelse',
            'title' => 'Lösenord',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'nuvarande position',
                'user_interests' => 'intressen',
                'user_msnm' => '',
                'user_occ' => 'sysselsättning',
                'user_twitter' => '',
                'user_website' => 'hemsida',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'uppdatera',
        ],
    ],

    'oauth' => [
        'title' => '',
        'authorized_clients' => '',
    ],

    'update_email' => [
        'email_subject' => 'bekräfta ändrad osu! e-postadress',
        'update' => 'uppdatera',
    ],

    'update_password' => [
        'email_subject' => 'bekräfta ändrat osu! lösenord',
        'update' => 'uppdatera',
    ],

    'playstyles' => [
        'title' => 'Spelstil',
        'mouse' => 'mus',
        'keyboard' => 'tangentbord',
        'tablet' => 'platta',
        'touch' => 'pekskärm',
    ],

    'privacy' => [
        'title' => 'Sekretess',
        'friends_only' => 'Blockera privata meddelanden från icke-vänner',
        'hide_online' => '',
    ],

    'notifications' => [
        'title' => '',
        'topic_auto_subscribe' => '',
    ],

    'security' => [
        'current_session' => '',
        'end_session' => '',
        'end_session_confirmation' => '',
        'last_active' => '',
        'title' => '',
        'web_sessions' => '',
    ],
];
