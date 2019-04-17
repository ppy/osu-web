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
        'title' => '<strong>Kontoinnstillinger</strong>',
        'title_compact' => 'innstillinger',
        'username' => 'brukernavn',

        'avatar' => [
            'title' => 'Profilbilde',
        ],

        'email' => [
            'current' => 'nåværende e-post',
            'new' => 'ny e-post',
            'new_confirmation' => 'bekreft e-post',
            'title' => 'E-post',
        ],

        'password' => [
            'current' => 'nåværende passord',
            'new' => 'nytt passord',
            'new_confirmation' => 'bekreft passord',
            'title' => 'Passord',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'nåværende plassering',
                'user_interests' => 'interesser',
                'user_msnm' => '',
                'user_occ' => 'yrke',
                'user_twitter' => '',
                'user_website' => 'nettside',
                'user_discord' => '',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'oppdater',
        ],
    ],

    'update_email' => [
        'email_subject' => 'osu! e-post endringsbekreftelse',
        'update' => 'oppdater',
    ],

    'update_password' => [
        'email_subject' => 'Bekreft endring av passord på osu!',
        'update' => 'oppdater',
    ],

    'playstyles' => [
        'title' => 'Spillestiler',
        'mouse' => 'mus',
        'keyboard' => 'tastatur',
        'tablet' => 'tegnebrett',
        'touch' => 'touch-skjerm',
    ],

    'privacy' => [
        'title' => 'Personvern',
        'friends_only' => 'blokker private meldinger fra personer som ikke er på vennelisten din',
        'hide_online' => 'skjul påloggingsstatus',
    ],

    'security' => [
        'current_session' => 'nåværende',
        'end_session' => 'Avslutt økt',
        'end_session_confirmation' => 'Dette vil ummidelbart avslutte økten på denne enheten. Er du sikker?',
        'last_active' => 'Sist aktiv:',
        'title' => 'Sikkerhet',
        'web_sessions' => 'websideøkter',
    ],
];
