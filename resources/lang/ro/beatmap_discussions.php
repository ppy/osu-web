<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
            'only_unresolved' => '',
            'types' => 'Tipuri de mesaje',
            'username' => 'Nume de utilizator',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
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

    'system' => [
        'resolved' => [
            'true' => 'Marcat ca rezolvat de :user',
            'false' => 'Redeschis de :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Toată lumea',
        'label' => 'Filtrează după utilizator',
    ],
];
