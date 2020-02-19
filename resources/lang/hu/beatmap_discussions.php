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
        'title' => 'Beatmap Megbeszélés',

        'form' => [
            '_' => 'Keresés',
            'deleted' => 'Törölt beszélgetések mellékelése',
            'only_unresolved' => '',
            'types' => 'Üzenettípusok',
            'username' => 'Felhasználónév',

            'beatmapset_status' => [
                '_' => '',
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
        'go_to_child' => '',
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
            'true' => 'Megoldottnak jelölve :user által',
            'false' => 'Újranyitva :user által',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Mindenki',
        'label' => 'Szűrés felhasználó szerint',
    ],
];
