<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Kirjaudu sisään muokataksesi.',
            'system_generated' => 'Automaattisesti luotua viestiä ei voi muokata.',
            'wrong_user' => 'Vain aiheen omistaja pystyy muokkaamaan.',
        ],
    ],

    'events' => [
        'empty' => 'Mitään ei ole tapahtunut... vielä.',
    ],

    'index' => [
        'deleted_beatmap' => 'poistettu',
        'none_found' => 'Hakukriteereihin täsmääviä keskusteluja ei löytynyt.',
        'title' => 'Beatmapkeskustelut',

        'form' => [
            '_' => 'Hae',
            'deleted' => 'Sisällytä poistetut keskustelut',
            'mode' => 'Beatmap-tila',
            'only_unresolved' => 'Näytä vain ratkaisemattomat keskustelut',
            'types' => 'Viestityypit',
            'username' => 'Käyttäjänimi',

            'beatmapset_status' => [
                '_' => 'Beatmapin tila',
                'all' => 'Kaikki',
                'disqualified' => 'Hylätty',
                'never_qualified' => '',
                'qualified' => 'Hyväksytty',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Käyttäjä',
                'overview' => 'Tapahtumakatsaus',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Lähetetty',
        'deleted_at' => 'Poistettu',
        'message_type' => 'Tyyppi',
        'permalink' => 'Pysyvä linkki',
    ],

    'nearby_posts' => [
        'confirm' => 'Mikään viesteistä ei käsittele aihettani',
        'notice' => 'Aikajanalta :timestamp (:existing_timestamps) löytyy viestejä. Tarkista ne ennen viestin lähettämistä.',
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
            'guest' => 'Kirjaudu sisään vastataksesi',
            'user' => 'Vastaa',
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
            'true' => ':user on merkinnyt ratkaistuksi',
            'false' => ':user avasi uudelleen',
        ],
    ],

    'timestamp_display' => [
        'general' => 'yleiset',
        'general_all' => 'yleiset (kaikki)',
    ],

    'user_filter' => [
        'everyone' => 'Jokainen',
        'label' => 'Suodata käyttäjien mukaan',
    ],
];
