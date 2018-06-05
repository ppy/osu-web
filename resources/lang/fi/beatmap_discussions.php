<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
            'null_user' => 'Sinun on kirjauduttava sisään muokataksesi.',
            'system_generated' => 'Automaattisesti luotua viestiä ei voi muokata.',
            'wrong_user' => 'Vain lähettäjä voi muokata viestiä.',
        ],
    ],

    'events' => [
        'empty' => 'Mitään ei ole tapahtunut... vielä.',
    ],

    'index' => [
        'deleted_beatmap' => 'poistettu',
        'title' => 'Rytmikarttojen keskustelut',

        'form' => [
            'deleted' => 'Sisällytä poistetut keskustelut',

            'user' => [
                'label' => 'Käyttäjä',
                'overview' => 'Tapahtumakatsaus',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Lähetyspäivä',
        'deleted_at' => 'Poistopäivä',
        'message_type' => 'Tyyppi',
        'permalink' => 'Pysyvä linkki',
    ],

    'nearby_posts' => [
        'confirm' => 'Mikään viesteistä ei käsittele asiaani',
        'notice' => 'On olemassa viestejä ajalta :timestamp (:existing_timestamps). Tarkista ne ennen viestin lähettämistä.',
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
            'false' => ':user on avannut uudelleen',
        ],
    ],

    'user' => [
        'admin' => 'ylläpitäjä',
        'bng' => 'ehdolle asettaja',
        'owner' => 'kartoittaja',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'Kaikki',
        'label' => 'Suodata käyttäjän mukaan',
    ],
];
