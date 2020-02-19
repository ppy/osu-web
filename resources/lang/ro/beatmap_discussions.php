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
            'null_user' => 'Trebuie să fii autentificat pentru a edita.',
            'system_generated' => 'Postările generate de sistem nu pot fi editate.',
            'wrong_user' => 'Trebuie să fii proprietarul postării pentru a o edita.',
        ],
    ],

    'events' => [
        'empty' => 'Nu s-a întâmplat nimic... încă.',
    ],

    'index' => [
        'deleted_beatmap' => 'șters',
        'title' => 'Discuții despre beatmap',

        'form' => [
            '_' => 'Caută',
            'deleted' => 'Include discuțiile șterse',
            'only_unresolved' => 'Arată doar discuții nerezolvate',
            'types' => 'Tipuri de mesaje',
            'username' => 'Nume de utilizator',

            'beatmapset_status' => [
                '_' => 'Status de Beatmap',
                'all' => 'Tot',
                'disqualified' => 'Descalificat',
                'never_qualified' => 'Niciodată Calificat',
                'qualified' => 'Calificat',
                'ranked' => 'Clasat',
            ],

            'user' => [
                'label' => 'Utilizator',
                'overview' => 'Sumarul activității',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Data postării',
        'deleted_at' => 'Data ștergerii',
        'message_type' => 'Tip',
        'permalink' => 'Link permanent',
    ],

    'nearby_posts' => [
        'confirm' => 'Niciuna dintre aceste postări nu mă preocupă',
        'notice' => 'Există postări în jurul :timestamp (:existing_timestamps). Te rugăm să verifici înainte de a posta.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Conectează-te pentru a răspunde',
            'user' => 'Răspunde',
        ],
    ],

    'review' => [
        'go_to_parent' => 'Vezi review-ul utilizatorului',
        'go_to_child' => 'Vezi Discuția',
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
            'true' => 'Marcat ca rezolvat de :user',
            'false' => 'Redeschis de :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'general',
        'general_all' => 'general (tot)',
    ],

    'user_filter' => [
        'everyone' => 'Toată lumea',
        'label' => 'Filtrează după utilizator',
    ],
];
