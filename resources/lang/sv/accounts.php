<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'kontoinställningar',
        'username' => 'användarnamn',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'återställ',
            'rules' => 'Se till att din avatar följer :link.<br/>Det betyder att den måste vara <strong>lämplig för alla åldrar</strong>. dvs. ingen nakenhet, svordomar eller suggestivt innehåll.',
            'rules_link' => 'gemenskapsreglerna',
        ],

        'email' => [
            'new' => 'ny e-postadress',
            'new_confirmation' => 'e-postbekräftelse',
            'title' => 'E-postadress',
            'locked' => [
                '_' => 'Kontakta :accounts: om du behöver uppdatera din email-address.',
                'accounts' => 'kontosupportteam',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc,',
            'title' => 'Legacy API',
        ],

        'password' => [
            'current' => 'nuvarande lösenord',
            'new' => 'nytt lösenord',
            'new_confirmation' => 'lösenordsbekräftelse',
            'title' => 'Lösenord',
        ],

        'profile' => [
            'country' => 'land',
            'title' => 'Profil',

            'country_change' => [
                '_' => "Det verkar som om att ditt kontos land inte matchar landet du befinner dig i. :update_link.",
                'update_link' => 'Uppdatera till :country',
            ],

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

    'github_user' => [
        'info' => "Om du är medverkande till osu!'s öppen källkodsarkiv, kommer länkning av ditt GitHub-konto här att associera dina changelog-poster med din osu! profil. GitHub-konton utan medverkningshistorik till osu! kan inte länkas.",
        'link' => 'Länka GitHub-konto',
        'title' => 'GitHub',
        'unlink' => 'Unlink GitHub Account',

        'error' => [
            'already_linked' => 'Detta GitHub-konto är redan kopplat till en annan användare.',
            'no_contribution' => 'Kan inte länka GitHub-konto utan någon medverkningshistorik i osu! utvecklingskataloger.',
            'unverified_email' => 'Vänligen verifiera din primära e-postadress på GitHub, försök sedan att länka ditt konto igen.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'ta emot aviseringar om nya problem på kvalificerade beatmaps i följande spellägen',
        'beatmapset_disqualify' => 'ta emot aviseringar när beatmaps för följande lägen diskvalificeras',
        'comment_reply' => 'ta emot aviseringar för svar på dina kommentarer',
        'title' => 'Aviseringar',
        'topic_auto_subscribe' => 'aktivera aviseringar automatiskt på nya forumtrådar som du skapar ',

        'options' => [
            '_' => 'leveransalternativ',
            'beatmap_owner_change' => 'gästsvårighetsgrad',
            'beatmapset:modding' => 'beatmapmodding',
            'channel_message' => 'privata chattmeddelanden',
            'channel_team' => '',
            'comment_new' => 'nya kommentarer',
            'forum_topic_reply' => 'ämnessvar',
            'mail' => 'e-post',
            'mapping' => 'beatmap-ägare',
            'push' => 'push',
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
            '_' => 'standard nedladdningstyp för beatmaps',
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
        'end_session_confirmation' => 'Detta kommer omedelbart avsluta din session på den valda enheten. Är du säker?',
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
        'text' => 'Du kan stänga detta fönster nu',
        'title' => 'Verifieringen har slutförts',
    ],

    'verification_invalid' => [
        'title' => 'Ogiltig eller utgången verifieringslänk',
    ],
];
