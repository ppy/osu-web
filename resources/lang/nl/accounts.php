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
        'title' => '<strong>Account</strong> Instellingen',
        'title_compact' => 'instellingen',
        'username' => 'gebruikersnaam',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'huidige e-mail',
            'new' => 'nieuwe e-mail',
            'new_confirmation' => 'e-mail bevestiging',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'huidige wachtwoord',
            'new' => 'nieuwe wachtwoord',
            'new_confirmation' => 'wachtwoord bevestiging',
            'title' => 'Wachtwoord',
        ],

        'profile' => [
            'title' => 'Profiel',

            'user' => [
                'user_from' => 'huidige locatie',
                'user_interests' => 'interesses',
                'user_msnm' => 'skype',
                'user_occ' => 'bezigheid',
                'user_twitter' => 'twitter',
                'user_website' => 'website',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Ondertekening',
            'update' => 'bijwerken',
        ],
    ],

    'update_email' => [
        'email_subject' => 'osu! e-mail wijziging bevestigen',
        'update' => 'bijwerken',
    ],

    'update_password' => [
        'email_subject' => 'osu! wachtwoord wijziging bevestiging',
        'update' => 'bijwerken',
    ],

    'playstyles' => [
        'title' => 'Speelstijlen',
        'mouse' => 'muis',
        'keyboard' => 'toetsenbord',
        'tablet' => 'tablet',
        'touch' => 'touch',
    ],

    'privacy' => [
        'title' => 'Privacy',
        'friends_only' => 'blokkeer privéberichten van mensen niet in jouw vriendenlijst',
        'hide_online' => 'verberg je online aanwezigheid',
    ],

    'security' => [
        'current_session' => 'huidige',
        'end_session' => 'Stop de sessie',
        'end_session_confirmation' => 'Dit zal onmiddellijk je sessie op dat apparaat beëindigen. Weet je het zeker?',
        'last_active' => 'Laatst actief:',
        'title' => 'Beveiliging',
        'web_sessions' => 'web sessies',
    ],
];
