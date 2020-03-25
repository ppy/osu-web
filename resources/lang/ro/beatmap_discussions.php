<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => '',
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
