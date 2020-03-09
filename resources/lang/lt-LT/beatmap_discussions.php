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
            'null_user' => 'Redagavimui reikia prisijungti.',
            'system_generated' => 'Sistemos sugeneruotos žinutės negali būti redaguojamos.',
            'wrong_user' => 'Redaguoti gali tik žinutės siuntėjas.',
        ],
    ],

    'events' => [
        'empty' => 'Kol kas nieko neįvyko...',
    ],

    'index' => [
        'deleted_beatmap' => 'ištrintas',
        'none_found' => '',
        'title' => 'Beatmapo Diskusijos',

        'form' => [
            '_' => 'Ieškoti',
            'deleted' => 'Įtraukti ištrintas diskusijas',
            'only_unresolved' => 'Rodyti tiktais neišspręstas diskusijas',
            'types' => 'Žinutės tipai',
            'username' => 'Vartotojo vardas',

            'beatmapset_status' => [
                '_' => '„Beatmap“ Statusas',
                'all' => 'Visi',
                'disqualified' => 'Diskvalifikuotas',
                'never_qualified' => 'Niekada nekvalifikuotas',
                'qualified' => 'Kvalifikuotas',
                'ranked' => 'Patvirtintas',
            ],

            'user' => [
                'label' => 'Vartotojas',
                'overview' => 'Veiklos peržiūra',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Pranešimo data',
        'deleted_at' => 'Ištrynimo data',
        'message_type' => 'Tipas',
        'permalink' => 'Nuoroda',
    ],

    'nearby_posts' => [
        'confirm' => 'Nei viena žinutė neišsprendžia mano rūpesčių',
        'notice' => 'Šios žinutės išsiųstos :timestamp (:existing_timestamps). Peržiūrėk jas, prieš siunčiant naują.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Atsakymui reikia prisijungti',
            'user' => 'Atsakyti',
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
            'true' => ':user pažymėjo kaip išspręsta',
            'false' => ':user atidarė vėl',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Visi',
        'label' => 'Filtruoti pagal vartotoją',
    ],
];
