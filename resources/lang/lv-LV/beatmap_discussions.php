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
    ],

    'reply' => [
        'open' => [
            'guest' => 'Pierakstieties, lai atbildētu',
            'user' => 'Atbildēt',
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
