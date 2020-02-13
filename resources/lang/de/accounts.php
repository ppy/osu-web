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
        'title_compact' => 'einstellungen',
        'username' => 'benutzername',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Bitte stelle sicher, dass sich dein Avatar an :link hält.<br/>Das heißt, es muss <strong>für alle Altersklassen geeignet</strong> sein. Z.B. keine Nacktheit, Obszönität oder anstößiger Inhalt.',
            'rules_link' => 'die Community Regeln',
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
                'user_discord' => 'discord',
                'user_from' => 'aktueller standort',
                'user_interests' => 'Interessen',
                'user_msnm' => 'skype',
                'user_occ' => 'beschäftigung',
                'user_twitter' => 'twitter',
                'user_website' => 'webseite',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'speichern',
        ],
    ],

    'notifications' => [
        'title' => 'Nachrichten',
        'topic_auto_subscribe' => 'aktiviere Nachrichten automatisch bei neue Forum Themen die du erstellst',
        'beatmapset_discussion_qualified_problem' => 'erhalte Benachrichtigungen für neue Probleme auf qualifizierten Beatmaps von folgenden Modi',

        'mail' => [
            '_' => 'E-Mail-Benachrichtigungen erhalten für',
            'beatmapset:modding' => 'Beatmap-Modifizierung',
            'forum_topic_reply' => 'Antwort auf ein Thema',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorisierte Geräte',
        'own_clients' => 'eigene Geräte',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'Tastatur',
        'mouse' => 'Maus',
        'tablet' => 'Tablet',
        'title' => 'Spielstil',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'Blockiere Nachrichten von Benutzern, die nicht auf deiner Freundesliste sind',
        'hide_online' => 'Online-Status verstecken',
        'title' => 'Privatsphäre',
    ],

    'security' => [
        'current_session' => 'Aktuell',
        'end_session' => 'Sitzung beenden',
        'end_session_confirmation' => 'Das wird deine Sitzung auf diesem Gerät sofort beenden. Bist du sicher?',
        'last_active' => 'Zuletzt aktiv:',
        'title' => 'Sicherheit',
        'web_sessions' => 'Sitzungen',
    ],

    'update_email' => [
        'update' => 'speichern',
    ],

    'update_password' => [
        'update' => 'speichern',
    ],

    'verification_completed' => [
        'text' => 'Sie können diesen Tab/Fenster jetzt schließen',
        'title' => 'Überprüfung wurde abgeschlossen',
    ],

    'verification_invalid' => [
        'title' => 'Ungültiger oder abgelaufener Bestätigungslink',
    ],
];
