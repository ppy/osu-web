<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'innstillinger',
        'username' => 'brukernavn',

        'avatar' => [
            'title' => 'Profilbilde',
            'rules' => 'Vennligst sørg for at profilbildet ditt følger :link<br/>Dette betyr at det må være <strong>passende for alle aldersgrupper</strong>. d.v.s. ingen nakenhet, upassende språk eller innhold.',
            'rules_link' => 'Samfunns regler',
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
        'beatmapset_discussion_qualified_problem' => 'motta varsler for nye problemer på kvalifiserte beatmaps av følgende moduser',
        'beatmapset_disqualify' => '',
        'title' => 'Varsler',
        'topic_auto_subscribe' => 'aktiver automatiske varslinger på nye forum emner som du lager',

        'options' => [
            '_' => '',
            'beatmapset:modding' => '',
            'channel_message' => '',
            'comment_new' => '',
            'forum_topic_reply' => '',
            'mail' => '',
            'push' => '',
            'user_achievement_unlock' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autoriserte applikasjoner',
        'own_clients' => 'egne klienter',
        'title' => 'OAuth',
    ],

    'options' => [
        'title' => 'Innstillinger',

        'beatmapset_download' => [
            '_' => 'standard nedlastingstype for beatmap',
            'all' => 'med video hvis tilgjengelig',
            'no_video' => 'uten video',
            'direct' => 'åpne i osu!direct',
        ],

        'beatmapset_title_show_original' => '',
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
