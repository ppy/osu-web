<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'setări',
        'username' => 'nume de utilizator',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Te rog asigură-te că avatar-ul tău respectă :link<br/>Asta înseamnă că trebuie să fie <strong>adecvat pentru toate vârstele</strong>. Care să nu conțină nuditate, profanare sau conținut sugestiv.',
            'rules_link' => 'regulile comunității',
        ],

        'email' => [
            'current' => 'e-mail curent',
            'new' => 'e-mail nou',
            'new_confirmation' => 'confirmare e-mail',
            'title' => 'E-mail',
        ],

        'password' => [
            'current' => 'parola curentă',
            'new' => 'parolă nouă',
            'new_confirmation' => 'confirmare parolă',
            'title' => 'Parolă',
        ],

        'profile' => [
            'title' => 'Profil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'locație curentă',
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
        'beatmapset_discussion_qualified_problem' => 'primește notificări pentru noi probleme pe hărți calificate de modelele următoare',
        'beatmapset_disqualify' => 'primește notificări pentru când beatmap-urile din modurile următoare sunt descalificate',
        'comment_reply' => 'primește notificări pentru răspunsurile la comentariile tale',
        'title' => 'Notificări',
        'topic_auto_subscribe' => 'activați notificările automat pe noi topici de pe forum pe care le poți creea',

        'options' => [
            '_' => 'opțiuni de livrare',
            'beatmap_owner_change' => 'dificultatea oaspeţilor',
            'beatmapset:modding' => 'modatul de beatmap',
            'channel_message' => 'mesaje chat private',
            'comment_new' => 'comentarii noi',
            'forum_topic_reply' => 'răspuns topic',
            'mail' => 'mail',
            'mapping' => 'cartografiere beatmap',
            'push' => 'push',
            'user_achievement_unlock' => 'medalie de utilizator deblocată',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clienți autorizați',
        'own_clients' => 'deține Client',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ascunde avertismente pentru conținut explicit în beatmaps',
        'beatmapset_title_show_original' => 'arată metadatele beatmap în limba originală',
        'title' => 'Opțiuni',

        'beatmapset_download' => [
            '_' => 'tip implicit de descărcare de beatmap',
            'all' => 'cu video dacă e disponibil',
            'direct' => 'deschis în osu!direct',
            'no_video' => 'fără video',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'tastatură',
        'mouse' => 'mouse',
        'tablet' => 'tabletă',
        'title' => 'Stiluri de joc',
        'touch' => 'touch',
    ],

    'privacy' => [
        'friends_only' => 'Blochează mesajele private de la oameni care nu sunt pe lista ta de prieteni',
        'hide_online' => 'ascunde-ți prezența online',
        'title' => 'Confidențialitate',
    ],

    'security' => [
        'current_session' => 'curent',
        'end_session' => 'Încheie sesiunea',
        'end_session_confirmation' => 'Acest lucru iți va încheia imediat sesiunea pe acel dispozitiv. Ești sigur?',
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
