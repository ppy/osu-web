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
                'all' => 'Kaikki',
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
            'true' => ':user on merkinnyt ratkaistuksi',
            'false' => ':user avasi uudelleen',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Jokainen',
        'label' => 'Suodata käyttäjien mukaan',
    ],
];
