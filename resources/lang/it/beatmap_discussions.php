<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Devi avere effettuato il login per modificare.',
            'system_generated' => 'I post generati dal sistema non possono essere modificati.',
            'wrong_user' => 'Devi essere l\'autore del post per modificarlo.',
        ],
    ],

    'events' => [
        'empty' => 'Non è successo nulla... per ora.',
    ],

    'index' => [
        'deleted_beatmap' => 'eliminato',
        'title' => 'Discussioni Beatmap',

        'form' => [
            '_' => 'Cerca',
            'deleted' => 'Includi discussioni eliminate',
            'only_unresolved' => '',
            'types' => 'Tipi di messaggio',
            'username' => 'Nome Utente',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Utente',
                'overview' => 'Panoramica delle attività',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data del Post',
        'deleted_at' => 'Data di eliminazione',
        'message_type' => 'Tipo',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Nessuno dei post riguarda il mio problema',
        'notice' => 'Ci sono già dei post verso :timestamp (:existing_timestamps). Controlla prima di postare.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Registrati per Rispondere',
            'user' => 'Rispondi',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Segnato come risolto da :user',
            'false' => 'Riaperto da :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Tutti',
        'label' => 'Filtra per utente',
    ],
];
