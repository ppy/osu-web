<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'Einstellungen',
        'username' => 'Benutzername',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'Zurücksetzen',
            'rules' => 'Bitte stelle sicher, dass sich dein Avatar an :link hält.<br/>Das heißt, er muss <strong>für alle Altersklassen geeignet</strong> sein und darf keine Nacktheit oder anstößigen Inhalte enthalten.',
            'rules_link' => 'die Community-Regeln',
        ],

        'email' => [
            'new' => 'Neue E-Mail',
            'new_confirmation' => 'E-Mail bestätigen',
            'title' => 'E-Mail',
            'locked' => [
                '_' => 'Bitte kontaktiere das :accounts, wenn du deine E-Mail-Adresse aktualisieren möchtest.',
                'accounts' => 'Account-Support-Team',
            ],
        ],

        'legacy_api' => [
            'api' => 'API',
            'irc' => 'IRC',
            'title' => 'Legacy-API',
        ],

        'password' => [
            'current' => 'Aktuelles Passwort',
            'new' => 'Neues Passwort',
            'new_confirmation' => 'Passwort bestätigen',
            'title' => 'Passwort',
        ],

        'profile' => [
            'country' => 'Land',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Es sieht so aus, als ob das Land deines Accounts nicht mit dem Land deines Wohnsitzes übereinstimmt. :update_link.",
                'update_link' => 'Zu :country ändern',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'Aktueller Standort',
                'user_interests' => 'Interessen',
                'user_occ' => 'Beschäftigung',
                'user_twitter' => '',
                'user_website' => 'Webseite',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'speichern',
        ],
    ],

    'github_user' => [
        'info' => "Wenn du zu den Open-Source-Repositories von osu! beiträgst, kannst du dein GitHub-Konto hier verlinken, um deine Changelog-Einträge mit deinem osu!-Profil zu verknüpfen. GitHub-Konten ohne Beitragshistorie zu osu! können nicht verknüpft werden.",
        'link' => 'GitHub-Konto verknüpfen',
        'title' => 'GitHub',
        'unlink' => 'GitHub-Konto entkoppeln',

        'error' => [
            'already_linked' => 'Dein GitHub-Konto ist bereits mit einem anderen Benutzerkonto verknüpft.',
            'no_contribution' => 'GitHub-Konto ohne Beitragshistorie in osu!-Repositories kann nicht verknüpft werden.',
            'unverified_email' => 'Bitte verifiziere deine primäre E-Mail-Adresse auf GitHub und versuche dann, dein Konto erneut zu verknüpfen.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'Erhalte Benachrichtigungen für neue Probleme auf qualifizierten Beatmaps von folgenden Modi',
        'beatmapset_disqualify' => 'Erhalte Benachrichtigungen, wenn Beatmaps der folgenden Modi disqualifiziert werden',
        'comment_reply' => 'Erhalte Benachrichtigungen für Antworten auf deine Kommentare',
        'news_post' => 'Erhalte Benachrichtigungen bei Neuigkeiten',
        'title' => 'Benachrichtigungen',
        'topic_auto_subscribe' => 'Benachrichtigungen zu den Forenposts, die du erstellt oder auf die du geantwortet hast, immer aktivieren',

        'options' => [
            '_' => 'Zustelloptionen',
            'beatmap_owner_change' => 'Guest-Difficulty',
            'beatmapset:modding' => 'Beatmap-Modding',
            'channel_message' => 'Private Chat-Nachrichten',
            'channel_team' => 'Nachrichten im Team-Chat',
            'comment_new' => 'Neue Kommentare',
            'forum_topic_reply' => 'Antwort auf Forenthema',
            'mail' => 'Mail',
            'mapping' => 'Beatmap-Mapper',
            'news_post' => 'Neuigkeiten',
            'push' => 'Push',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'Autorisierte Anwendungen',
        'own_clients' => 'Eigene Anwendungen',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'Warnungen für expliziten Inhalt in Beatmaps ausblenden',
        'beatmapset_title_show_original' => 'Beatmap-Metadaten in Originalsprache anzeigen',
        'title' => 'Optionen',

        'beatmapset_download' => [
            '_' => 'Bevorzuge Beatmap-Download-Typ',
            'all' => 'mit Video, falls verfügbar',
            'direct' => 'in osu!direct öffnen',
            'no_video' => 'ohne Video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'Tastatur',
        'mouse' => 'Maus',
        'tablet' => 'Tablet',
        'title' => 'Spielstil',
        'touch' => 'Touch',
    ],

    'privacy' => [
        'friends_only' => 'Blockiere Nachrichten von Benutzern, die nicht in deiner Freundesliste sind',
        'hide_online' => 'Online-Status verbergen',
        'hide_online_info' => 'Dies entspricht dem "Offline"-Modus in osu!lazer',
        'title' => 'Privatsphäre',
    ],

    'security' => [
        'current_session' => 'aktuell',
        'end_session' => 'Sitzung beenden',
        'end_session_confirmation' => 'Das wird deine Sitzung auf diesem Gerät sofort beenden. Bist du sicher?',
        'last_active' => 'Zuletzt aktiv:',
        'title' => 'Sicherheit',
        'web_sessions' => 'Web-Sitzungen',
    ],

    'update_email' => [
        'update' => 'speichern',
    ],

    'update_password' => [
        'update' => 'speichern',
    ],

    'user_totp' => [
        'title' => 'Zwei-Faktor-Authentifizierung',
        'usage_note' => 'Nutze die Authentifizierungs-App anstatt der E-Mail zur Authentifizierung. Die Authentifizierung per E-Mail wird weiterhin als Alternative zur Verfügung stehen.',

        'button' => [
            'remove' => 'Entfernen',
            'setup' => 'Zwei-Faktor-Authentifizierung hinzufügen',
        ],
        'status' => [
            'label' => 'Status',
            'not_set' => 'Deaktiviert',
            'set' => 'Aktiviert',
        ],
    ],

    'verification_completed' => [
        'text' => 'Du kannst diesen Tab/dieses Fenster nun schließen',
        'title' => 'Verifizierung abgeschlossen',
    ],

    'verification_invalid' => [
        'title' => 'Ungültiger oder abgelaufener Verifizierungslink',
    ],
];
