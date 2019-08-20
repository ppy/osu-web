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
        'title' => 'Discussioni di beatmap',

        'form' => [
            '_' => 'Cerca',
            'deleted' => 'Includi discussioni eliminate',
            'types' => 'Tipo di messaggio',
            'username' => 'Nome Utente',

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
        'notice' => 'Ci sono già post a :timestamp (:existing_timestamps). Si prega di controllare prima di postare.',
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
