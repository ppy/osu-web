<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Nessuna discussione corrispondente ai criteri di ricerca trovata.',
        'title' => 'Discussioni Beatmap',

        'form' => [
            '_' => 'Cerca',
            'deleted' => 'Includi discussioni eliminate',
            'only_unresolved' => 'Mostra solo le discussioni in sospeso',
            'types' => 'Tipi di messaggio',
            'username' => 'Nome Utente',

            'beatmapset_status' => [
                '_' => 'Stato Beatmap',
                'all' => 'Tutti',
                'disqualified' => 'Squalificata',
                'never_qualified' => 'Mai Qualificata',
                'qualified' => 'Qualificata',
                'ranked' => 'Rankata',
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

    'review' => [
        'go_to_parent' => 'Visualizza il post della recensione',
        'go_to_child' => 'Visualizza discussione',
        'validation' => [
            'invalid_block_type' => 'tipo di blocco non valido',
            'invalid_document' => 'recensione non valida',
            'minimum_issues' => 'la recensione deve contenere almeno :count problema|la recensione deve contenere almeno :count problemi',
            'missing_text' => 'il blocco non ha testo',
            'too_many_blocks' => 'le recensioni possono contenere solo :count paragrafo/problema|le recensioni possono contenere fino a :count paragrafi/problemi',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Segnato come risolto da :user',
            'false' => 'Riaperto da :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'generale',
        'general_all' => 'generale (tutti)',
    ],

    'user_filter' => [
        'everyone' => 'Tutti',
        'label' => 'Filtra per utente',
    ],
];
