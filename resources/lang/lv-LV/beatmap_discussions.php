<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Ir jāparakstās lai rediģētu.',
            'system_generated' => 'Automātiski ģenerēts ziņojums nevar tikt izmainīts.',
            'wrong_user' => 'Ir jābūt īpašniekam lai rediģēt ziņu.',
        ],
    ],

    'events' => [
        'empty' => 'Nekas nav noticis... pagaidām.',
    ],

    'index' => [
        'deleted_beatmap' => 'izdzēsts',
        'none_found' => '',
        'title' => 'Diskusija par bītkarti',

        'form' => [
            '_' => 'Meklēt',
            'deleted' => 'Iekļaut dzēstās diskusijas',
            'mode' => '',
            'only_unresolved' => 'Rādīt tikai neatrisinātās diskusijas',
            'types' => 'Ziņojumu veidi',
            'username' => 'Lietotājvārds',

            'beatmapset_status' => [
                '_' => 'Bītmapes Stāvoklis',
                'all' => 'Visi',
                'disqualified' => 'Diskvalificēts',
                'never_qualified' => 'Nav Kvalificēts',
                'qualified' => 'Kvalificēts',
                'ranked' => 'Rankots',
            ],

            'user' => [
                'label' => 'Lietotājs',
                'overview' => 'Aktivitātes pārskats',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Ziņas datums',
        'deleted_at' => 'Dzēšanas datums',
        'message_type' => 'Tips',
        'permalink' => 'Pastāvīgā saite',
    ],

    'nearby_posts' => [
        'confirm' => 'Neviens no ziņojumiem neadresē manu problēmu',
        'notice' => 'Šeit ir ziņojums ap :timestamp (:existing_timestamps). Lūzu pārbaudiet tos pirms ziņojat.',
        'unsaved' => '',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Pierakstieties, lai atbildētu',
            'user' => 'Atbildēt',
        ],
    ],

    'review' => [
        'block_count' => '',
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'block_too_large' => '',
            'external_references' => '',
            'invalid_block_type' => '',
            'invalid_document' => '',
            'invalid_discussion_type' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Atzīmēts, kā atrisināts no :user',
            'false' => 'Atkārtoti atvērts: :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Visi',
        'label' => 'Filtrēts pēc lietotāja izvēles',
    ],
];
