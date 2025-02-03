<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Du skal være logget ind for at kunne redigere.',
            'system_generated' => 'System-genererede opslag kan ikke redigeres.',
            'wrong_user' => 'Du skal være ejeren af opslaget for at kunne redigere det.',
        ],
    ],

    'events' => [
        'empty' => 'Der er ikke sket noget... endnu.',
    ],

    'index' => [
        'deleted_beatmap' => 'slettet',
        'none_found' => 'Ingen diskussion der macher det søgekriterie var fundet.',
        'title' => 'Beatmap Diskussioner',

        'form' => [
            '_' => 'Søg',
            'deleted' => 'Inkluder slettede diskussioner',
            'mode' => 'Beatmap tilstand',
            'only_unresolved' => 'Vis kun uløste diskussioner',
            'show_review_embeds' => '',
            'types' => 'Meddelelsestyper',
            'username' => 'Brugernavn',

            'beatmapset_status' => [
                '_' => 'Beatmap Status',
                'all' => 'Alle',
                'disqualified' => 'Diskvalificeret',
                'never_qualified' => 'Ikke kvalificeret',
                'qualified' => 'Kvalificeret',
                'ranked' => 'Ranked',
            ],

            'user' => [
                'label' => 'Bruger',
                'overview' => 'Aktivitets-oversigt',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Opslagsdato',
        'deleted_at' => 'Sletnings dato',
        'message_type' => 'Skriv',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Ingen af opslagene angår mine bekymringer',
        'notice' => 'Der er opslag omkring :timestamp (:existing_timestamps). Vær venlig at tjekke dem inden du slår noget op.',
        'unsaved' => ':count i denne anmeldelse',
    ],

    'owner_editor' => [
        'button' => 'Sværhedsgrad Ejer',
        'reset_confirm' => 'Nulstil ejeren for denne sværhedsgrad?',
        'user' => 'Ejer',
        'version' => 'Sværhedsgrad',
    ],

    'refresh' => [
        'checking' => '',
        'has_updates' => '',
        'no_updates' => '',
        'updating' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Log ind for at svare',
            'user' => 'Svar',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max blokke brugt',
        'go_to_parent' => 'Vis Anmeldelses-opslag',
        'go_to_child' => 'Vis Diskussion',
        'validation' => [
            'block_too_large' => 'hver blok må kun indeholde op til :limit tegn',
            'external_references' => 'anmeldelse indholder referencer til problemer som ikke hører til denne anmeldelse',
            'invalid_block_type' => 'ugyldig block type',
            'invalid_document' => 'ugyldig vurdering',
            'invalid_discussion_type' => 'ugyldig diskussionstype',
            'minimum_issues' => 'vurdering skal som minimum indeholde :count fejl|vurdering skal som minimum indholde :count fejl',
            'missing_text' => 'block mangler tekst',
            'too_many_blocks' => 'vurderinger må kun indeholde :count afsnit/problem|vurderinger må kun indeholde op til :count afsnit/problemer',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marker som løst af :user',
            'false' => 'Genåbnet af :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'generelt',
        'general_all' => 'generelt (alle)',
    ],

    'user_filter' => [
        'everyone' => 'Alle',
        'label' => 'Filtrer efter bruger',
    ],
];
