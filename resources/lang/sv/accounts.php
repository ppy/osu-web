<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'kontoinställningar',
        'username' => 'användarnamn',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Se till att din avatar följer :link.<br/>Det betyder att den måste vara <strong>lämplig för alla åldrar</strong>. dvs ingen nakenhet, svordomar eller suggestivt innehåll.',
            'rules_link' => 'gemenskapsreglerna',
        ],

        'email' => [
            'current' => 'nuvarande e-postadress',
            'new' => 'ny e-postadress',
            'new_confirmation' => 'e-postbekräftelse',
            'title' => 'E-postadress',
        ],

        'password' => [
            'current' => 'nuvarande lösenord',
            'new' => 'nytt lösenord',
            'new_confirmation' => 'lösenordsbekräftelse',
            'title' => 'Lösenord',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'nuvarande position',
                'user_interests' => 'intressen',
                'user_msnm' => '',
                'user_occ' => 'sysselsättning',
                'user_twitter' => '',
                'user_website' => 'hemsida',
            ],
        ],

        'signature' => [
            'title' => 'Signatur',
            'update' => 'uppdatera',
        ],
    ],

    'notifications' => [
        'title' => 'Aviseringar',
        'topic_auto_subscribe' => 'aktivera aviseringar automatiskt på nya forumtrådar som du skapar ',
        'beatmapset_discussion_qualified_problem' => 'ta emot meddelanden om nya problem på kvalificerade beatmaps över följande lägen',

        'mail' => [
            '_' => 'få e-postaviseringar för ',
            'beatmapset:modding' => 'beatmap modding',
            'forum_topic_reply' => 'tråd-svar',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'auktoriserade klienter',
        'own_clients' => 'egna klienter',
        'title' => 'OAuth',
    ],

    'options' => [
        'title' => 'Alternativ',

        'beatmapset_download' => [
            '_' => 'standard beatmap nedladdningstyp',
            'all' => 'med video om tillgängligt',
            'no_video' => 'utan video',
            'direct' => 'öppna i osu!direct',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tangentbord',
        'mouse' => 'mus',
        'tablet' => 'platta',
        'title' => 'Spelsätt',
        'touch' => 'pekskärm',
    ],

    'privacy' => [
        'friends_only' => 'Blockera privata meddelanden från icke-vänner',
        'hide_online' => 'dölj din online-närvaro',
        'title' => 'Sekretess',
    ],

    'security' => [
        'current_session' => 'nuvarande',
        'end_session' => 'Avsluta sessionen',
        'end_session_confirmation' => 'Detta kommer avsluta din session på den valda enheten. Är du säker?',
        'last_active' => 'Senast aktiv:',
        'title' => 'Säkerhet',
        'web_sessions' => 'webbsessioner',
    ],

    'update_email' => [
        'update' => 'uppdatera',
    ],

    'update_password' => [
        'update' => 'uppdatera',
    ],

    'verification_completed' => [
        'text' => 'Du kan stänga detta fönstret nu',
        'title' => 'Verifieringen har slutförts',
    ],

    'verification_invalid' => [
        'title' => 'Ogiltig eller utgånget verifieringslänk',
    ],
];
