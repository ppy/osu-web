<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Du må være logget inn for å redigere.',
            'system_generated' => 'Systemgenererte innlegg kan ikke redigeres.',
            'wrong_user' => 'Du må være eier av innlegget for å redigere.',
        ],
    ],

    'events' => [
        'empty' => 'Ingenting har skjedd... enda.',
    ],

    'index' => [
        'deleted_beatmap' => 'slettet',
        'title' => 'Beatmapdiskusjoner',

        'form' => [
            '_' => 'Søk',
            'deleted' => 'Inkluder slettede diskusjoner',
            'only_unresolved' => '',
            'types' => 'Meldingstyper',
            'username' => 'Brukernavn',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Bruker',
                'overview' => 'Aktivitetsoversikt',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Publiseringsdato',
        'deleted_at' => 'Slettingsdato',
        'message_type' => 'Type',
        'permalink' => 'Permalenke',
    ],

    'nearby_posts' => [
        'confirm' => 'Ingen av innleggene gjelder mine bekymringer',
        'notice' => 'Det er innlegg rundt :timestamp (:existing_timestamps). Vennligst gjennomgå dem før publisering.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Logg inn for å svare',
            'user' => 'Svar',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Merket som løst av :user',
            'false' => 'Gjenåpnet av :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Alle',
        'label' => 'Filtrer etter bruker',
    ],
];
