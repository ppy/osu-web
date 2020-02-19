<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
 *
 *    This file is part of osu!web. osu!web is distributed with the hope of
 *    attracting more community contributions to the core ecosystem of osu!.
 *
 *    osu!web is free software: you can redistribute it and/or modify
 *    it under the terms of the Affero GNU General Public License version 3
 *    as published by the Free Software Foundation.
 *
 *    osu!web is distributed WITHOUT ANY WARRANTY; without even the implied
 *    warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *    See the GNU Affero General Public License for more details.
 *
 *    You should have received a copy of the GNU Affero General Public License
 *    along with osu!web.  If not, see <http://www.gnu.org/licenses/>.
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
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
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
