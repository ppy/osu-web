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
            'new' => 'ny email',
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
                'user_occ' => 'beskæftigelse',
                'user_twitter' => '',
                'user_website' => 'hjemmeside',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'opdater',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'modtag notifikationer for nye problemer på kvalificerede beatmaps for de følgende spileltilstande',
        'beatmapset_disqualify' => 'modtag notifikationer når beatmaps af følgende modes bliver diskvalificeret',
        'comment_reply' => 'modtag notifikationer når der bliver svaret på dine kommentarer',
        'title' => 'Notifikationer',
        'topic_auto_subscribe' => 'aktiver automatisk notifikationer på nye forum emner du opretter',

        'options' => [
            '_' => 'leveringsmuligheder',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'beatmap modding',
            'channel_message' => 'privat beskeder',
            'comment_new' => 'nye kommentarer',
            'forum_topic_reply' => 'emne svar',
            'mail' => 'post',
            'mapping' => 'beatmap mapper',
            'push' => 'push',
            'user_achievement_unlock' => 'bruger medalje låst op',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoriserede klienter',
        'own_clients' => 'egne klienter',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'skjul advarsler for eksplicit indhold i beatmaps',
        'beatmapset_title_show_original' => 'vis beatmap metadata på originalt sprog',
        'title' => 'Indstillinger',

        'beatmapset_download' => [
            '_' => 'standard beatmap download type',
            'all' => 'inkluder video hvis tilgængelig',
            'direct' => 'open med osu!direct',
            'no_video' => 'uden video',
        ],
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
