<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'indstillinger',
        'username' => 'brugernavn',

        'avatar' => [
            'title' => 'Profilbillede',
            'reset' => 'genstart',
            'rules' => 'Vær sikker på at din avatar overholder :link.<br/>Dette betyder at den skal være <strong>passende for alle aldre</strong>. Det betyder ingen nøgenhed, skælsord eller suggestivt indhold.',
            'rules_link' => 'fællesskabs-reglerne',
        ],

        'email' => [
            'new' => 'ny email',
            'new_confirmation' => 'email bekræftelse',
            'title' => 'Email',
            'locked' => [
                '_' => 'Venligst kontakt :accounts his du har brug for at opdatere din email.',
                'accounts' => 'kontohjælp',
            ],
        ],

        'legacy_api' => [
            'api' => '',
            'irc' => '',
            'title' => '',
        ],

        'password' => [
            'current' => 'nuværende adgangskode',
            'new' => 'ny adgangskode',
            'new_confirmation' => 'bekræftelse af adgangskode',
            'title' => 'Adgangskode',
        ],

        'profile' => [
            'country' => 'land',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Det ser ud til at dit konto-land ikke er det samme som dit bopælslands. :update_link.",
                'update_link' => 'Opdater til :country',
            ],

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

    'github_user' => [
        'info' => "",
        'link' => 'Tilknyt GitHub konto',
        'title' => 'GitHub',
        'unlink' => 'Fjern GitHub konto',

        'error' => [
            'already_linked' => 'Denne GitHub konto er allerede tilknyttet en anden bruger.',
            'no_contribution' => '',
            'unverified_email' => 'Venligst bekræft din primære email på GitHub, og efterfølgende prøv at tilknytte din konto igen.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'modtag notifikationer for nye problemer på kvalificerede beatmaps for de følgende spileltilstande',
        'beatmapset_disqualify' => 'modtag notifikationer når beatmaps af følgende modes bliver diskvalificeret',
        'comment_reply' => 'modtag notifikationer når der bliver svaret på dine kommentarer',
        'news_post' => '',
        'title' => 'Notifikationer',
        'topic_auto_subscribe' => 'aktiver automatisk notifikationer på nye forum emner du opretter',

        'options' => [
            '_' => 'leveringsmuligheder',
            'beatmap_owner_change' => 'gæst sværhedsgrad',
            'beatmapset:modding' => 'beatmap modding',
            'channel_message' => 'privat beskeder',
            'channel_team' => '',
            'comment_new' => 'nye kommentarer',
            'forum_topic_reply' => 'emne svar',
            'mail' => 'post',
            'mapping' => 'beatmap mapper',
            'news_post' => '',
            'push' => 'push',
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
        'hide_online_info' => '',
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

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => 'Du kan nu lukke dette vindue',
        'title' => 'Verifikation færdiggjort',
    ],

    'verification_invalid' => [
        'title' => 'Ugyldigt eller udløbet verifikations-link',
    ],
];
