<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

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
        'title' => 'Beatmapkeskustelut',

        'form' => [
            '_' => 'Hae',
            'deleted' => 'Sisällytä poistetut keskustelut',
            'only_unresolved' => '',
            'types' => 'Viestityypit',
            'username' => 'Käyttäjänimi',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
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
    ],

    'reply' => [
        'open' => [
            'guest' => 'Kirjaudu sisään vastataksesi',
            'user' => 'Vastaa',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':user on merkinnyt ratkaistuksi',
            'false' => ':user avasi uudelleen',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Jokainen',
        'label' => 'Suodata käyttäjien mukaan',
    ],
];
