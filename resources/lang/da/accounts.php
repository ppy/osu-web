<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
