<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'configuració del compte',
        'username' => 'nom d’usuari',

        'avatar' => [
            'title' => 'Avatar',
            'rules' => 'Si us plau asseguri\'s que el seu avatar s\'adhereix a :link. <br/> Això vol dir que ha de ser <strong>adequat per a totes les edats</strong>. És a dir, sense nuesa, blasfèmia o contingut suggestiu.',
            'rules_link' => 'regles de la comunitat',
        ],

        'email' => [
            'new' => 'nou correu electrònic',
            'new_confirmation' => 'confirmació per correu electrònic',
            'title' => 'Correu electrònic',
        ],

        'password' => [
            'current' => 'contrasenya actual',
            'new' => 'nova contrasenya',
            'new_confirmation' => 'confirmació de contrasenya',
            'title' => 'Contrasenya',
        ],

        'profile' => [
            'title' => 'Perfil',

            'user' => [
                'user_discord' => '',
                'user_from' => 'ubicació actual',
                'user_interests' => 'interessos',
                'user_occ' => 'ocupació',
                'user_twitter' => '',
                'user_website' => 'lloc web',
            ],
        ],

        'signature' => [
            'title' => 'Signatura',
            'update' => 'actualitzar',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'rebre notificacions de nous problemes en beatmaps qualificats dels següents modes',
        'beatmapset_disqualify' => 'rebre notificacions per quan els beatmaps dels següents modes siguin desqualificats',
        'comment_reply' => 'rebre notificacions de respostes als vostres comentaris',
        'title' => 'Notificacions',
        'topic_auto_subscribe' => 'habilita automàticament les notificacions en els nous temes de fòrum que creeu',

        'options' => [
            '_' => 'opcions d\'entrega',
            'beatmap_owner_change' => 'dificultat de convidat',
            'beatmapset:modding' => 'modding de beatmaps',
            'channel_message' => 'missatges de xat privats',
            'comment_new' => 'comentaris nous',
            'forum_topic_reply' => 'resposta del tema',
            'mail' => 'correu',
            'mapping' => 'creador de beatmaps',
            'push' => 'push',
            'user_achievement_unlock' => 'medalla d\'usuari desbloquejada',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clients autoritzats',
        'own_clients' => 'clients propis',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'amagar advertiments per a contingut explícit en beatmaps',
        'beatmapset_title_show_original' => 'mostra les metadades del beatmap en l\'idioma original',
        'title' => 'Opcions',

        'beatmapset_download' => [
            '_' => 'tipus de baixada de mapa predeterminat',
            'all' => 'amb vídeo si està disponible',
            'direct' => 'obrir a osu!direct',
            'no_video' => 'sense vídeo',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'teclat',
        'mouse' => 'ratolí',
        'tablet' => 'tauleta',
        'title' => 'Estils de joc',
        'touch' => 'tocar',
    ],

    'privacy' => [
        'friends_only' => 'bloca els missatges privats de persones que no són a la llista d\'amics',
        'hide_online' => 'amaga la teva presència en línia',
        'title' => 'Privadesa',
    ],

    'security' => [
        'current_session' => 'actual',
        'end_session' => 'Finalitzar sessió',
        'end_session_confirmation' => 'Això finalitzarà immediatament la sessió en aquest dispositiu. Estàs segur?',
        'last_active' => 'Última connexió:',
        'title' => 'Seguretat',
        'web_sessions' => 'sessions web',
    ],

    'update_email' => [
        'update' => 'actualitzar',
    ],

    'update_password' => [
        'update' => 'actualitzar',
    ],

    'verification_completed' => [
        'text' => 'Ja pots tancar aquesta pestanya/finestra',
        'title' => 'Verificació completada',
    ],

    'verification_invalid' => [
        'title' => 'Enllaç de verificació no vàlid o caducat',
    ],
];
