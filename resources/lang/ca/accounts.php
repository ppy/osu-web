<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'configuració del compte',
        'username' => 'nom d’usuari',

        'avatar' => [
            'title' => 'Avatar',
            'reset' => 'restableix',
            'rules' => 'Si us plau asseguri\'s que el seu avatar s\'adhereix a :link. <br/> Això vol dir que ha de ser <strong>adequat per a totes les edats</strong>. És a dir, sense nuesa, blasfèmia o contingut suggestiu.',
            'rules_link' => 'consideracions del contingut visual',
        ],

        'email' => [
            'new' => 'correu electrònic nou',
            'new_confirmation' => 'confirmació per correu electrònic',
            'title' => 'Correu electrònic',
            'locked' => [
                '_' => 'Si us plau, contacta amb el :accounts si necessites que s\'actualitzi el teu correu electrònic.',
                'accounts' => 'equip de suport de comptes',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API heretada',
        ],

        'password' => [
            'current' => 'contrasenya actual',
            'new' => 'nova contrasenya',
            'new_confirmation' => 'confirmació de contrasenya',
            'title' => 'Contrasenya',
        ],

        'profile' => [
            'country' => 'país',
            'title' => 'Perfil',

            'country_change' => [
                '_' => "Sembla que el país del teu compte no coincideix amb el teu país de residència. :update_link.",
                'update_link' => 'Canvia a :country',
            ],

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
            'update' => 'actualitza',
        ],
    ],

    'github_user' => [
        'info' => "Si ets un col·laborador dels repositoris de codi obert d'osu!, enllaçant el teu compte de GitHub aquí, s'associarà les entrades del registre de canvis amb el teu perfil d'osu!. Comptes de GitHub sense historial de contribucions a osu! no es poden enllaçar.",
        'link' => 'Enllaça el compte de GitHub',
        'title' => 'GitHub',
        'unlink' => 'Desenllaça el compte de GitHub',

        'error' => [
            'already_linked' => 'Aquest compte de GitHub ja està enllaçat a un usuari diferent.',
            'no_contribution' => 'No es pot enllaçar el compte de GitHub sense cap historial de contribucions als repositoris d\'osu!',
            'unverified_email' => 'Verifica el teu correu electrònic principal a GitHub i torna a provar d\'enllaçar el teu compte.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'rebre notificacions de nous problemes en mapes qualificats dels següents modes',
        'beatmapset_disqualify' => 'rebre notificacions per quan els mapes dels següents modes siguin desqualificats',
        'comment_reply' => 'rebre notificacions de respostes als teus comentaris',
        'title' => 'Notificacions',
        'topic_auto_subscribe' => 'habilita automàticament les notificacions en els nous temes de fòrum que creis or responguis',

        'options' => [
            '_' => 'opcions d\'entrega',
            'beatmap_owner_change' => 'dificultat de convidat',
            'beatmapset:modding' => 'moding de mapes',
            'channel_message' => 'missatges de xat privats',
            'channel_team' => 'missatges de xat privats',
            'comment_new' => 'comentaris nous',
            'forum_topic_reply' => 'resposta del tema',
            'mail' => 'correu',
            'mapping' => 'edició de mapes',
            'push' => 'emergent',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'clients autoritzats',
        'own_clients' => 'clients propis',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'oculta els avisos per al contingut explícit en mapes',
        'beatmapset_title_show_original' => 'mostra les metadades del mapa en l\'idioma original',
        'title' => 'Opcions',

        'beatmapset_download' => [
            '_' => 'tipus de baixada de beatmap predeterminat',
            'all' => 'amb vídeo si està disponible',
            'direct' => 'obre a osu!direct',
            'no_video' => 'sense vídeo',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'teclat',
        'mouse' => 'ratolí',
        'tablet' => 'tauleta',
        'title' => 'Estils de joc',
        'touch' => 'pantalla tàctil',
    ],

    'privacy' => [
        'friends_only' => 'bloca els missatges privats de persones que no són a la llista d\'amics',
        'hide_online' => 'amaga la teva presència en línia',
        'hide_online_info' => '',
        'title' => 'Privadesa',
    ],

    'security' => [
        'current_session' => 'actual',
        'end_session' => 'Tanca la sessió',
        'end_session_confirmation' => 'Això tancarà immediatament la sessió en aquest dispositiu. N\'esteu segur?',
        'last_active' => 'Última connexió:',
        'title' => 'Seguretat',
        'web_sessions' => 'sessions web',
    ],

    'update_email' => [
        'update' => 'actualitza',
    ],

    'update_password' => [
        'update' => 'actualitza',
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
        'text' => 'Ja pots tancar aquesta pestanya/finestra',
        'title' => 'Verificació completada',
    ],

    'verification_invalid' => [
        'title' => 'Enllaç de verificació no vàlid o caducat',
    ],
];
