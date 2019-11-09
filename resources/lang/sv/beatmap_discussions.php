<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
                'all' => '',
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

    'system' => [
        'resolved' => [
            'true' => 'Markerad som löst av :user',
            'false' => 'Öppnad igen av :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Alla',
        'label' => 'Filtrera på användare',
    ],
];
