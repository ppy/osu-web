<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'setări cont',
        'username' => 'nume de utilizator',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Te rugăm să te asiguri că avatar-ul tău respectă :link<br/>Asta înseamnă că trebuie să fie <strong>adecvat pentru toate vârstele</strong>. spre ex. fără nuditate, vulgarități sau conținut sugestiv.',
            'rules_link' => 'regulile comunității',
        ],

        'email' => [
            'new' => 'e-mail nou',
            'new_confirmation' => 'confirmare e-mail',
            'title' => 'E-mail',
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API Vechi',
        ],

        'password' => [
            'current' => 'parola actuală',
            'new' => 'parolă nouă',
            'new_confirmation' => 'confirmare parolă',
            'title' => 'Parolă',
        ],

        'profile' => [
            'country' => '',
            'title' => 'Profil',

            'country_change' => [
                '_' => "",
                'update_link' => '',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'locație actuală',
                'user_interests' => 'interese',
                'user_occ' => 'ocupație',
                'user_twitter' => '',
                'user_website' => 'site web',
            ],
        ],

        'signature' => [
            'title' => 'Semnătură',
            'update' => 'actualizează',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'primește notificări pentru probleme noi pe hărți calificate pentru modurile următoare',
        'beatmapset_disqualify' => 'primește notificări când beatmap-urile din modurile următoare sunt descalificate',
        'comment_reply' => 'primește notificări pentru răspunsurile la comentariile tale',
        'title' => 'Notificări',
        'topic_auto_subscribe' => 'activează automat notificările pe subiecte noi din forum pe care le creați',

        'options' => [
            '_' => 'opțiuni de livrare',
            'beatmap_owner_change' => 'dificultatea oaspeților',
            'beatmapset:modding' => 'modding beatmap-uri',
            'channel_message' => 'mesaje chat private',
            'comment_new' => 'comentarii noi',
            'forum_topic_reply' => 'răspuns subiect',
            'mail' => 'mail',
            'mapping' => 'creator beatmap',
            'push' => 'push',
            'user_achievement_unlock' => 'medalie de utilizator deblocată',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clienți autorizați',
        'own_clients' => 'clienți proprii',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ascunde avertismente pentru conținut obscen în beatmap-uri',
        'beatmapset_title_show_original' => 'arată datele melodiilor în limba originală',
        'title' => 'Opțiuni',

        'beatmapset_download' => [
            '_' => 'tip implicit de descărcare a beatmap-urilor',
            'all' => 'cu video dacă e disponibil',
            'direct' => 'deschide în osu!direct',
            'no_video' => 'fără video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tastatură',
        'mouse' => 'mouse',
        'tablet' => 'tabletă',
        'title' => 'Stiluri de joc',
        'touch' => 'ecran tactil',
    ],

    'privacy' => [
        'friends_only' => 'blochează mesajele private de la oameni care nu sunt pe lista ta de prieteni',
        'hide_online' => 'ascunde-ți prezența online',
        'title' => 'Confidențialitate',
    ],

    'security' => [
        'current_session' => 'actual',
        'end_session' => 'Încheie sesiunea',
        'end_session_confirmation' => 'Acest lucru iți va încheia instantaneu sesiunea pe acel dispozitiv. Ești sigur?',
        'last_active' => 'Ultima conectare:',
        'title' => 'Securitate',
        'web_sessions' => 'sesiuni web',
    ],

    'update_email' => [
        'update' => 'actualizează',
    ],

    'update_password' => [
        'update' => 'actualizează',
    ],

    'verification_completed' => [
        'text' => 'Poți închide această fereastră acum',
        'title' => 'Verificarea a fost finalizată',
    ],

    'verification_invalid' => [
        'title' => 'Link de verificare invalid sau expirat',
    ],
];
