<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'iestatījumi',
        'username' => 'lietotājvārds',

        'avatar' => [
            'title' => 'Avatārs',
            'reset' => 'atiestatīt',
            'rules' => 'Lūdzu, pārliecinieties, ka jūsu profila attēls atbilst :link.<br/>Tas nozīmē, ka attēlam jābūt <strong>piemērotam visiem vecumiem</strong>, t.i., bez kailuma, rupjībām vai ierosinoša satura.',
            'rules_link' => 'kopienas noteikumi',
        ],

        'email' => [
            'new' => 'jauns e-pasts',
            'new_confirmation' => 'e-pasta apstiprinājums',
            'title' => 'E-pasts',
            'locked' => [
                '_' => 'Lūdzu, sazinieties ar :accounts, ja vēlies atjaunināt savu e-pasta adresi.',
                'accounts' => 'kontu atbalsta komanda',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'Legacy API',
        ],

        'password' => [
            'current' => 'pašreizējā parole',
            'new' => 'jaunā parole',
            'new_confirmation' => 'paroles apstiprinājums',
            'title' => 'Parole',
        ],

        'profile' => [
            'country' => 'valsts',
            'title' => 'Profils',

            'country_change' => [
                '_' => "Izskatās, ka konta valsts nesakrīt ar jūsu dzīvesvietas valsti. :update_link.",
                'update_link' => 'Atjaunināt uz :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'pašreizējā atrašanās vieta',
                'user_interests' => 'intereses',
                'user_occ' => 'nodarbošanās',
                'user_twitter' => '',
                'user_website' => 'tīmekļa vietne',
            ],
        ],

        'signature' => [
            'title' => 'Paraksts',
            'update' => 'atjaunināt',
        ],
    ],

    'github_user' => [
        'info' => "Ja esi ieguldītājs osu! atvērtā koda repozitorijos, sasaistot savu GitHub kontu šeit, tavi izmaiņu žurnāla ieraksti tiks saistīti ar tavu osu! profilu. GitHub kontus, kuriem nav ieguldījumu vēstures osu!, nevar sasaistīt.",
        'link' => 'Pievienot GitHub kontu',
        'title' => 'GitHub',
        'unlink' => 'Atsaistīt GitHub kontu',

        'error' => [
            'already_linked' => 'Šis GitHub konts jau ir pievienots citam lietotājam.',
            'no_contribution' => 'Nevar sasaistīt GitHub kontu bez jebkādas ieguldījumu vēstures osu! repozitorijos.',
            'unverified_email' => 'Lūdzu, apstiprini savu primāro e-pasta adresi GitHub un pēc tam mēģini vēlreiz sasaistīt kontu.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'saņemt paziņojumus par jaunām problēmām, kas saistītas ar kvalificētām šādu spēles veida ritma-kartēmmap',
        'beatmapset_disqualify' => 'saņemt paziņojumus, kad tiek diskvalificētas šāda spēles veida  ritma-kartes',
        'comment_reply' => 'saņemt paziņojumus par atbildēm uz saviem komentāriem',
        'title' => 'Paziņojumi',
        'topic_auto_subscribe' => 'automātiski ieslēgt paziņojumus foruma tematiem, kurus esiet izveidojis',

        'options' => [
            '_' => 'piegādes opcijas',
            'beatmap_owner_change' => 'viesa grūtības līmenis',
            'beatmapset:modding' => 'ritma-karšu modifikācijas',
            'channel_message' => 'privātās tērzētavas ziņas',
            'channel_team' => 'komandas tērzētavas ziņas',
            'comment_new' => 'jauni komentāri',
            'forum_topic_reply' => 'tēmas atbilde',
            'mail' => 'pasts',
            'mapping' => 'ritma-kartes izveidotājs',
            'push' => 'piespiestu',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'autorizētie klienti',
        'own_clients' => 'savi klienti',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'slēpt brīdinājumus par nepiemērotu saturu ritma-mapēs',
        'beatmapset_title_show_original' => 'rādīt ritma-mapes metadatus oriģinālvalodā',
        'title' => 'Opcijas',

        'beatmapset_download' => [
            '_' => 'noklusējuma ritma-mapes lejupielādes tips',
            'all' => 'ar video, ja pieejams',
            'direct' => 'atvērt osu!direct',
            'no_video' => 'bez video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tastatūra',
        'mouse' => 'pele',
        'tablet' => 'grafiskā planšete',
        'title' => 'Spēlēšanās stili',
        'touch' => 'skārienjūtīgais ekrāns',
    ],

    'privacy' => [
        'friends_only' => 'bloķēt privātās ziņas no cilvēkiem, kuri nav jūsu draugu sarakstā',
        'hide_online' => 'slēpt jūsu tiešsaistes klātbūtni',
        'title' => 'Konfidencialitāte',
    ],

    'security' => [
        'current_session' => 'pašreizējais',
        'end_session' => 'Beigt sesiju',
        'end_session_confirmation' => 'Šis beigs jūsu sesiju uz šo ierīci. Vai esat pārliecināts?',
        'last_active' => 'Pēdējais aktīvs:',
        'title' => 'Drošība',
        'web_sessions' => 'tīmekļa sesijas',
    ],

    'update_email' => [
        'update' => 'atjaunināt',
    ],

    'update_password' => [
        'update' => 'atjaunināt',
    ],

    'verification_completed' => [
        'text' => 'Tagad varat aizvērt šo cilni/logu',
        'title' => 'Verifikācija ir pabeigta',
    ],

    'verification_invalid' => [
        'title' => 'Nederīga vai novecojusi verifikācijas saite',
    ],
];
