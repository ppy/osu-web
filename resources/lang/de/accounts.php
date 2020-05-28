<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'einstellungen',
        'username' => 'benutzername',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Bitte stelle sicher, dass sich dein Avatar an :link hält.<br/>Das heißt, er muss <strong>für alle Altersklassen geeignet</strong> sein. Z.B. keine Nacktheit, Obszönität oder anstößiger Inhalt.',
            'rules_link' => 'die Community-Regeln',
        ],

        'email' => [
            'current' => 'aktuelle e-mail',
            'new' => 'neue e-mail',
            'new_confirmation' => 'e-mail bestätigen',
            'title' => 'E-Mail',
        ],

        'password' => [
            'current' => 'aktuelles passwort',
            'new' => 'neues passwort',
            'new_confirmation' => 'passwort bestätigen',
            'title' => 'Passwort',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => 'discord',
                'user_from' => 'aktueller standort',
                'user_interests' => 'interessen',
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
        'title' => 'Benachrichtigungen',
        'topic_auto_subscribe' => 'automatisch benachrichtigungen zu neuen forenthreads, die du erstellst, aktivieren',
        'beatmapset_discussion_qualified_problem' => 'erhalte benachrichtigungen für neue probleme auf qualifizierten beatmaps der folgenden modi',

        'mail' => [
            '_' => 'e-mail-benachrichtigungen erhalten für',
            'beatmapset:modding' => 'beatmap-modding',
            'forum_topic_reply' => 'antwort auf einen thread',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorisierte clients',
        'own_clients' => 'eigene clients',
        'title' => 'OAuth',
    ],

    'options' => [
        'title' => 'Optionen',

        'beatmapset_download' => [
            '_' => 'standard-beatmap-download-typ',
            'all' => 'mit video, falls verfügbar',
            'no_video' => 'ohne video',
            'direct' => 'in osu!direct öffnen',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tastatur',
        'mouse' => 'maus',
        'tablet' => 'tablet',
        'title' => 'Spielstil',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'blockiere nachrichten von benutzern, die nicht auf deiner freundesliste sind',
        'hide_online' => 'online-status verbergen',
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
        'text' => 'Du kannst diesen Tab/dieses Fenster nun schließen',
        'title' => 'Verifizierung abgeschlossen',
    ],

    'verification_invalid' => [
        'title' => 'Ungültiger oder abgelaufener Verifizierungslink',
    ],
];
