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
            'null_user' => 'Måste vara inloggad för att redigera.',
            'system_generated' => 'System-genererade inlägg kan inte redigeras.',
            'wrong_user' => 'Måste vara ägare av inlägget för att redigera.',
        ],
    ],

    'events' => [
        'empty' => 'Inget har hänt... än.',
    ],

    'index' => [
        'deleted_beatmap' => 'raderad',
        'title' => 'Beatmap diskussioner',

        'form' => [
            '_' => 'Sök',
            'deleted' => 'Inkludera raderade diskussioner',
            'only_unresolved' => '',
            'types' => 'Typ av meddelande',
            'username' => 'Användarnamn',

            'beatmapset_status' => [
                '_' => '',
                'all' => 'Alla',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Användare',
                'overview' => 'Aktivitetsöversikt',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Skapad',
        'deleted_at' => 'Borttagen',
        'message_type' => 'Typ',
        'permalink' => 'Permalänk',
    ],

    'nearby_posts' => [
        'confirm' => 'Inga av dessa inlägg har med mig att göra',
        'notice' => 'Det finns inlägg runt :timestamp (:existing_timestamps). Var vänlig kontrollera detta innan du lägger upp ett inlägg.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Logga in för att svara',
            'user' => 'Svara',
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
            'true' => 'Markerad som löst av :user',
            'false' => 'Öppnad igen av :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Alla',
        'label' => 'Filtrera på användare',
    ],
];
