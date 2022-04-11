<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Za urejanje morate biti prijavljeni.',
            'system_generated' => 'Sistemsko generirane objave ni mogoče urejati.',
            'wrong_user' => 'Za urejanje morate biti lastnik objave.',
        ],
    ],

    'events' => [
        'empty' => 'Nič se ni zgodilo ... zaenkrat.',
    ],

    'index' => [
        'deleted_beatmap' => 'izbrisano',
        'none_found' => '',
        'title' => 'Razprave o beatmapih',

        'form' => [
            '_' => '',
            'deleted' => 'Vključi izbrisane razprave',
            'mode' => '',
            'only_unresolved' => '',
            'types' => '',
            'username' => '',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Uporabnik',
                'overview' => 'Pregled dejavnosti',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Datum objave',
        'deleted_at' => 'Datum izbrisa',
        'message_type' => 'Tip',
        'permalink' => 'Trajna povezava',
    ],

    'nearby_posts' => [
        'confirm' => 'Nobena objava ne obravnava mojih skrbi',
        'notice' => 'Okrog :timestamp je bilo objavljenih nekaj objav (:existing_timestamps). Prosimo, preverite jih, preden nekaj objavite sami.',
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
            'guest' => 'Prijavite se, da odgovorite',
            'user' => 'Odgovorite',
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
            'true' => ':user je označil kot razrešeno',
            'false' => ':user je znova odprl',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Vsi',
        'label' => 'Filtriraj po uporabnikih',
    ],
];
