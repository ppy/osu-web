<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'A szerkesztéshez be kell lépni.',
            'system_generated' => 'Rendszer által generált posztot nem lehet szerkeszteni.',
            'wrong_user' => 'Csak a tulajdonos szerkesztheti a posztot.',
        ],
    ],

    'events' => [
        'empty' => 'Semmi sem történt... eddig.',
    ],

    'index' => [
        'deleted_beatmap' => 'törölve',
        'none_found' => '',
        'title' => 'Beatmap Megbeszélés',

        'form' => [
            '_' => 'Keresés',
            'deleted' => 'Törölt beszélgetések mellékelése',
            'only_unresolved' => '',
            'types' => 'Üzenettípusok',
            'username' => 'Felhasználónév',

            'beatmapset_status' => [
                '_' => 'Beatmap státusz',
                'all' => 'Mind',
                'disqualified' => 'Diszkvalifikálva',
                'never_qualified' => 'Minősítetlen',
                'qualified' => 'Minősített',
                'ranked' => 'Rangsorolt',
            ],

            'user' => [
                'label' => 'Felhasználó',
                'overview' => 'Tevékenység áttekintés',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Beküldés időpontja',
        'deleted_at' => 'Törlés dátuma',
        'message_type' => 'Típus',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Egy poszt sem foglalkozik a problémámmal',
        'notice' => 'Már vannak posztok :timestamp (:existing_timestamps) körül. Kérlek nézd meg posztolás előtt.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Jelentkezz be a válaszoláshoz',
            'user' => 'Válasz',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => 'Megbeszélés megtekintése',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => 'érévnytelen értékelés',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Megoldottnak jelölve :user által',
            'false' => 'Újranyitva :user által',
        ],
    ],

    'timestamp_display' => [
        'general' => 'általános',
        'general_all' => 'általános (mind)',
    ],

    'user_filter' => [
        'everyone' => 'Mindenki',
        'label' => 'Szűrés felhasználó szerint',
    ],
];
