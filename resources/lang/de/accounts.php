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
        'title' => '<strong>Account</strong>einstellungen',
        'title_compact' => 'einstellungen',
        'username' => 'benutzername',

        'avatar' => [
            'title' => 'Avatar',
        ],

        'email' => [
            'current' => 'Aktuelle E-Mail Adresse',
            'new' => 'Neue E-Mail',
            'new_confirmation' => 'E-Mail bestätigen',
            'title' => 'E-Mail',
        ],

        'password' => [
            'current' => 'aktuelles passwort',
            'new' => 'neues passwort',
            'new_confirmation' => 'Passwort bestätigen',
            'title' => 'Passwort',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_from' => 'aktueller standort',
                'user_interests' => 'Interessen',
                'user_msnm' => 'skype',
                'user_occ' => 'beschäftigung',
                'user_twitter' => 'twitter',
                'user_website' => 'webseite',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'speichern',
        ],
    ],

    'update_email' => [
        'email_subject' => 'Bestätigung der neuen E-Mail-Adresse für osu!',
        'update' => 'speichern',
    ],

    'update_password' => [
        'email_subject' => 'Bestätigung des neuen Passworts für osu!',
        'update' => 'speichern',
    ],

    'playstyles' => [
        'title' => 'Spielstil',
        'mouse' => 'Maus',
        'keyboard' => 'Tastatur',
        'tablet' => 'Tablet',
        'touch' => 'touch',
    ],

    'privacy' => [
        'title' => 'Privatsphäre',
        'friends_only' => 'Blockiere Nachrichten von Benutzern, die nicht auf deiner Freundesliste sind',
        'hide_online' => 'Online-Status verstecken',
    ],

    'security' => [
        'current_session' => 'Aktuell',
        'end_session' => 'Sitzung beenden',
        'end_session_confirmation' => 'Das wird deine Sitzung auf diesem Gerät sofort beenden. Bist du sicher?',
        'last_active' => 'Zuletzt aktiv:',
        'title' => 'Sicherheit',
        'web_sessions' => 'Sitzungen',
    ],
];
