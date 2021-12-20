<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Måste vara inloggad för att kunna redigera.',
            'system_generated' => 'Systemgenererade inlägg kan inte redigeras.',
            'wrong_user' => 'Måste vara ägare till inlägget för att kunna redigera.',
        ],
    ],

    'events' => [
        'empty' => 'Inget har hänt... ännu.',
    ],

    'index' => [
        'deleted_beatmap' => 'raderad',
        'none_found' => 'Inga diskussioner som matchar det sökkriteriet hittades.',
        'title' => 'Beatmap diskussioner',

        'form' => [
            '_' => 'Sök',
            'deleted' => 'Inkludera raderade diskussioner',
            'mode' => 'Beatmapläge',
            'only_unresolved' => 'Visa bara olösta diskussioner',
            'types' => 'Typ av meddelande',
            'username' => 'Användarnamn',

            'beatmapset_status' => [
                '_' => 'Beatmap-status',
                'all' => 'Alla',
                'disqualified' => 'Diskvalificerad',
                'never_qualified' => 'Aldrig kvalificerad',
                'qualified' => 'Kvalificerad',
                'ranked' => 'Rankad',
            ],

            'user' => [
                'label' => 'Användare',
                'overview' => 'Aktivitetsöversikt',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Inläggningsdatum',
        'deleted_at' => 'Raderingsdatum',
        'message_type' => 'Typ',
        'permalink' => 'Permalänk',
    ],

    'nearby_posts' => [
        'confirm' => 'Inget av inläggen tar upp min oro',
        'notice' => 'Det finns inlägg runt :timestamp (:existing_timestamps). Var vänlig kontrollera dessa innan du lägger upp ett inlägg.',
        'unsaved' => ':count i denna recension',
    ],

    'owner_editor' => [
        'button' => 'Svårighetsgradens ägare',
        'reset_confirm' => 'Återställ ägare för denna svårighetsgrad?',
        'user' => 'Ägare',
        'version' => 'Svårighetsgrad',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Logga in för att svara',
            'user' => 'Svara',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max block används',
        'go_to_parent' => 'Visa granskningsinlägg',
        'go_to_child' => 'Visa diskussion',
        'validation' => [
            'block_too_large' => 'varje block får endast innehålla upp till :limit tecken',
            'external_references' => 'granskningen innehåller referenser till problem som inte hör till denna recension',
            'invalid_block_type' => 'ogiltig blocktyp',
            'invalid_document' => 'ogiltig granskning',
            'invalid_discussion_type' => 'ogiltig diskussionstyp',
            'minimum_issues' => 'granskningen måste innehålla minst :count problem|granskningen måste innehålla minst :count problem',
            'missing_text' => 'blocket saknar text',
            'too_many_blocks' => 'granskningarna måste endast innehålla :count stycke/problem granskningarna får endast innehålla upp till :count stycken/problem',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Markerad som löst av :user',
            'false' => 'Återöppnad av :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'allmänt',
        'general_all' => 'allmänt (alla)',
    ],

    'user_filter' => [
        'everyone' => 'Allihopa',
        'label' => 'Filtrera efter användare',
    ],
];
