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
            'null_user' => 'A szerkesztéshez be kell lépni.',
            'system_generated' => 'Rendszer által generált posztot nem lehet szerkeszteni.',
            'wrong_user' => 'A poszt szerkesztéséhez a tulajának kell lenned.',
        ],
    ],

    'events' => [
        'empty' => 'Semmi sem történt... eddig.',
    ],

    'index' => [
        'deleted_beatmap' => 'törölve',
        'title' => 'Beatmap Megbeszélés',

        'form' => [
            '_' => 'Keresés',
            'deleted' => 'Tartalmazza a törölt megbeszéléseket',
            'types' => 'Üzenet típusok',
            'username' => 'Felhasználónév',

            'user' => [
                'label' => 'Felhasználó',
                'overview' => 'Aktivitás áttekintő',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Beküldés időpontja',
        'deleted_at' => 'Törlés dátuma',
        'message_type' => 'Típus',
        'permalink' => 'Állandó hivatkozás',
    ],

    'nearby_posts' => [
        'confirm' => 'Egy poszt sem foglalkozik a problémámmal',
        'notice' => 'Ezek a posztok :timestamp (:existing_timestamps) körüliek.Kérlek posztolás előtt nézd meg őket.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Jelentkezz be a válaszoláshoz',
            'user' => 'Válasz',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Megoldott ként ként megjelölt :user felhasználó által',
            'false' => 'Újranyitva :user által',
        ],
    ],

    'user' => [
        'admin' => 'admin',
        'bng' => 'jelölő',
        'owner' => 'mappoló',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'Mindenki',
        'label' => 'Felhasználó által csoportositott',
    ],
];
