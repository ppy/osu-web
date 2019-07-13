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
        'title' => '<strong>Konto</strong> Indstillinger',
        'title_compact' => 'indstillinger',
        'username' => 'brugernavn',

        'avatar' => [
            'title' => 'Profilbillede',
        ],

        'email' => [
            'current' => 'nuværende email-adresse',
            'new' => 'ny email-adresse',
            'new_confirmation' => 'bekræftelse af email-adresse',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'nuværende adgangskode',
            'new' => 'ny adgangskode',
            'new_confirmation' => 'bekræftelse af adgangskode',
            'title' => 'Adgangskode',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'nuværende placering',
                'user_interests' => 'interesser',
                'user_msnm' => 'skype',
                'user_occ' => 'stilling',
                'user_twitter' => 'twitter',
                'user_website' => 'hjemmeside',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'opdater',
        ],
    ],

    'oauth' => [
        'title' => '',
        'authorized_clients' => '',
    ],

    'update_email' => [
        'email_subject' => 'Bekræftelse for opdatering af osu! email-adresse',
        'update' => 'opdater',
    ],

    'update_password' => [
        'email_subject' => 'Bekræftelse for opdatering af osu! adgangskode',
        'update' => 'opdater',
    ],

    'playstyles' => [
        'title' => 'Spillestile',
        'mouse' => 'mus',
        'keyboard' => 'tastatur',
        'tablet' => 'tablet',
        'touch' => 'touch',
    ],

    'privacy' => [
        'title' => 'Privacy',
        'friends_only' => 'Bloker private beskeder fra folk, der ikke er på din venneliste',
        'hide_online' => 'skjul din online status',
    ],

    'notifications' => [
        'title' => 'Notifikationer',
        'topic_auto_subscribe' => 'aktiver automatisk notifikationer på nye forum emner du opretter',
    ],

    'security' => [
        'current_session' => 'nuværende',
        'end_session' => 'Afslut Session',
        'end_session_confirmation' => 'Dette vil straks afslutte sessionen på enheden. Er du sikker?',
        'last_active' => 'Sidst aktiv:',
        'title' => 'Sikkerhed',
        'web_sessions' => 'websessioner',
    ],
];
