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
        'none_found' => 'Nicio discuție întâlnește criteriul acela de căutare.',
        'title' => 'Discuții despre beatmap',

        'form' => [
            '_' => 'Caută',
            'deleted' => 'Include discuțiile șterse',
            'mode' => '',
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
        'unsaved' => ':count în această recenzie',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Conectează-te pentru a răspunde',
            'user' => 'Răspunde',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blocuri folosite',
        'go_to_parent' => 'Vezi review-ul utilizatorului',
        'go_to_child' => 'Vezi Discuția',
        'validation' => [
            'block_too_large' => 'fiecare bloc poate conține până la :limit caractere',
            'external_references' => 'recenzia conține referințe la probleme care nu aparțin la această revizuire',
            'invalid_block_type' => 'tip de block invalid',
            'invalid_document' => 'recenzie invalidă',
            'invalid_discussion_type' => '',
            'minimum_issues' => 'recezia trebuie să conțină un minimum de :count problemă|recenzia trebuie să conțină un minimum de :count probleme',
            'missing_text' => 'block-ul e lipsit de text',
            'too_many_blocks' => 'recenziile pot să conțină doar :count paragrafe/probleme|recenziile pot să conțină doar până la :count paragrafe/probleme',
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
