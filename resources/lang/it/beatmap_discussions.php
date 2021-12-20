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
            'mode' => 'Modalità Beatmap',
            'only_unresolved' => 'Mostra solo discussioni irrisolte',
            'types' => 'Tipi di messaggio',
            'username' => 'Nome Utente',

            'beatmapset_status' => [
                '_' => 'Stato Beatmap',
                'all' => 'Tutti',
                'disqualified' => 'Squalificata',
                'never_qualified' => 'Mai Qualificata',
                'qualified' => 'Qualificata',
                'ranked' => 'Classificata',
            ],

            'user' => [
                'label' => 'Utente',
                'overview' => 'Panoramica delle attività',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data del post',
        'deleted_at' => 'Data di eliminazione',
        'message_type' => 'Tipo',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Nessuno dei post riguarda il mio problema',
        'notice' => 'Ci sono già dei post verso :timestamp (:existing_timestamps). Controlla prima di postare.',
        'unsaved' => ':count in questa revisione',
    ],

    'owner_editor' => [
        'button' => 'Mapper della difficoltà',
        'reset_confirm' => 'Ripristinare il proprietario per questa difficoltà?',
        'user' => 'Proprietario',
        'version' => 'Difficoltà',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Registrati per Rispondere',
            'user' => 'Rispondi',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocchi usati',
        'go_to_parent' => 'Visualizza il Post della Revisione',
        'go_to_child' => 'Visualizza Discussione',
        'validation' => [
            'block_too_large' => 'ogni blocco può contenere fino a :limit caratteri',
            'external_references' => 'la revisione contiene riferimenti a dei problemi che non appartengono a questa revisione',
            'invalid_block_type' => 'tipo di blocco non valido',
            'invalid_document' => 'revisione non valida',
            'invalid_discussion_type' => 'tipo di discussione non valido',
            'minimum_issues' => 'la revisione deve contenere almeno :count problema|la revisione deve contenere almeno :count problemi',
            'missing_text' => 'il blocco non ha testo',
            'too_many_blocks' => 'le revisioni possono contenere solo :count paragrafo/problema|le revisioni possono contenere fino a :count paragrafi/problemi',
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
