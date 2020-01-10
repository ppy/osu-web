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
        'title_compact' => 'indstillinger',
        'username' => 'brugernavn',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Vær sikker på at din avatar overholder :link.<br/>Dette betyder at den skal være <strong>passende for alle aldre</strong>. Det betyder ingen nøgenhed, skælsord eller suggestivt indhold.',
            'rules_link' => 'fællesskabs-reglerne',
        ],

        'email' => [
            'current' => 'nuværende email-adresse',
            'new' => 'ny email-adresse',
            'new_confirmation' => 'email bekræftelse',
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
                'user_discord' => '',
                'user_from' => 'nuværende placering',
                'user_interests' => 'interesser',
                'user_msnm' => 'skype',
                'user_occ' => 'beskæftigelse',
                'user_twitter' => 'twitter',
                'user_website' => 'hjemmeside',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'opdater',
        ],
    ],

    'notifications' => [
        'title' => 'Notifikationer',
        'topic_auto_subscribe' => 'aktiver automatisk notifikationer på nye forum emner du opretter',
        'beatmapset_discussion_qualified_problem' => 'modtag notifikationer for nye problemer på kvalificerede beatmaps for de følgende spileltilstande',

        'mail' => [
            '_' => 'modtag email notifikationer for',
            'beatmapset:modding' => 'beatmap modding',
            'forum_topic_reply' => 'emne svar',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoriserede klienter',
        'own_clients' => 'egne klienter',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'tastatur',
        'mouse' => 'mus',
        'tablet' => 'tablet',
        'title' => 'Spillestile',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'bloker privatbeskeder fra folk der ikke er på din venneliste',
        'hide_online' => 'skjul din online status',
        'title' => 'Privatliv',
    ],

    'security' => [
        'current_session' => 'nuværende',
        'end_session' => 'Afslut Sessionen',
        'end_session_confirmation' => 'Dette vil straks afslutte sessionen på enheden. Er du sikker?',
        'last_active' => 'Sidst aktiv:',
        'title' => 'Sikkerhed',
        'web_sessions' => 'websessioner',
    ],

    'update_email' => [
        'update' => 'opdater',
    ],

    'update_password' => [
        'update' => 'opdater',
    ],

    'verification_completed' => [
        'text' => 'Du kan nu lukke dette vindue',
        'title' => 'Verifikation færdiggjort',
    ],

    'verification_invalid' => [
        'title' => 'Ugyldigt eller udløbet verifikations-link',
    ],
];
