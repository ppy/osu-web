<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Du skal være logget ind for at kunne redigere.',
            'system_generated' => 'System-genererede opslag kan ikke redigeres.',
            'wrong_user' => 'Du skal være ejer af dette opslag for at kunne redigere.',
        ],
    ],

    'events' => [
        'empty' => 'Intet er sket...endnu.',
    ],

    'index' => [
        'deleted_beatmap' => 'slettet',
        'title' => 'Beatmap Diskussioner',

        'form' => [
            '_' => 'Søg',
            'deleted' => 'Inkluder slettede diskussioner',
            'only_unresolved' => '',
            'types' => 'Meddelelsestyper',
            'username' => 'Brugernavn',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Bruger',
                'overview' => 'Aktivitets oversigt',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Opslag dato',
        'deleted_at' => 'Sletnings dato',
        'message_type' => 'Skriv',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Ingen af opslagene angår mine bekymringer',
        'notice' => 'Der er opslag omkring :timestamp (:existing_timestamps). Vær venlig at tjekke dem inden du slår noget op.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Log ind for at svare',
            'user' => 'Svar',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marker som løst af :user',
            'false' => 'Genåbnet af :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Alle',
        'label' => 'Filtrer efter bruger',
    ],
];
