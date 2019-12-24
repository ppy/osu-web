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
        'title_compact' => 'innstillinger',
        'username' => 'brukernavn',

        'avatar' => [
            'title' => 'Profilbilde',
            'rules' => 'Vennligst sørg for at profilbildet ditt følger :link<br/>Dette betyr at det må være <strong>passende for alle aldersgrupper</strong>. d.v.s. ingen nakenhet, upassende språk eller innhold.',
            'rules_link' => '',
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
                'user_discord' => '',
                'user_from' => 'nåværende plassering',
                'user_interests' => 'interesser',
                'user_msnm' => '',
                'user_occ' => 'yrke',
                'user_twitter' => '',
                'user_website' => 'nettside',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'oppdater',
        ],
    ],

    'notifications' => [
        'title' => 'Varsler',
        'topic_auto_subscribe' => 'aktiver automatiske varslinger på nye forum emner som du lager',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoriserte applikasjoner',
        'own_clients' => 'egne klienter',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'tastatur',
        'mouse' => 'mus',
        'tablet' => 'tegnebrett',
        'title' => 'Spillemåter',
        'touch' => 'touch-skjerm',
    ],

    'privacy' => [
        'friends_only' => 'blokker private meldinger fra personer som ikke er på vennelisten din',
        'hide_online' => 'skjul påloggingsstatus',
        'title' => 'Personvern',
    ],

    'security' => [
        'current_session' => 'nåværende',
        'end_session' => 'Avslutt økt',
        'end_session_confirmation' => 'Dette vil umiddelbart avslutte økten på denne enheten. Er du sikker?',
        'last_active' => 'Sist aktiv:',
        'title' => 'Sikkerhet',
        'web_sessions' => 'websideøkter',
    ],

    'update_email' => [
        'update' => 'oppdater',
    ],

    'update_password' => [
        'update' => 'oppdater',
    ],

    'verification_completed' => [
        'text' => 'Du kan nå lukke dette vinduet/fanen',
        'title' => 'Verifisering fullført',
    ],

    'verification_invalid' => [
        'title' => 'Ugyldig eller utgått verifiseringslenke',
    ],
];
