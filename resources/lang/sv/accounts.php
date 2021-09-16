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
                'user_from' => 'nuvarande plats',
                'user_interests' => 'intressen',
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
        'beatmapset_discussion_qualified_problem' => 'ta emot aviseringar om nya problem på kvalificerade beatmaps i följande spellägen',
        'beatmapset_disqualify' => 'ta emot aviseringar när beatmaps för följande lägen diskvalificeras',
        'comment_reply' => 'motta aviseringar för svar på dina kommentarer',
        'title' => 'Aviseringar',
        'topic_auto_subscribe' => 'aktivera aviseringar automatiskt på nya forumtrådar som du skapar ',

        'options' => [
            '_' => 'leveransalternativ',
            'beatmap_owner_change' => 'gästsvårighetsgrad',
            'beatmapset:modding' => 'beatmap modding',
            'channel_message' => 'privata chattmeddelanden',
            'comment_new' => 'nya kommentarer',
            'forum_topic_reply' => 'ämnessvar',
            'mail' => 'mail',
            'mapping' => 'beatmap-ägare',
            'push' => 'push',
            'user_achievement_unlock' => 'användarmedalj upplåst',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'auktoriserade klienter',
        'own_clients' => 'egna klienter',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'dölj varningar för explicit innehåll i beatmaps',
        'beatmapset_title_show_original' => 'visa beatmapmetadata på originalspråk',
        'title' => 'Alternativ',

        'beatmapset_download' => [
            '_' => 'standard beatmap nedladdningstyp',
            'all' => 'med video om tillgängligt',
            'direct' => 'öppna i osu!direct',
            'no_video' => 'utan video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tangentbord',
        'mouse' => 'mus',
        'tablet' => 'ritplatta',
        'title' => 'Spelstil',
        'touch' => 'pekskärm',
    ],

    'privacy' => [
        'friends_only' => 'blockera privata meddelanden från icke-vänner',
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
        'title' => 'Ogiltig eller utgången verifieringslänk',
    ],
];
