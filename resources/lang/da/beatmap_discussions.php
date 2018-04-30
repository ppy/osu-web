<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'null_user' => 'Du skal være logget ind for at kunne redigere.', // Base text changed from "log" to "sign"
            'system_generated' => 'System-genererede opslag kan ikke redigeres.',
            'wrong_user' => 'Du skal være ejer af dette opslag for at kunne redigere.',
        ],
    ],

    'events' => [
        'empty' => 'Intet er sket...endnu.',
    ],

    'index' => [
        'deleted_beatmap' => 'slettet',
        'title' => 'Beatmap Diskussioner',

        'form' => [
            'deleted' => 'Inkluder slettede diskussioner',

            'user' => [
                'label' => 'Bruger',
                'overview' => 'Aktivitets oversigt',
            ],
        ],
    ],

    'nearby_posts' => [
        'confirm' => 'Ingen af opslagene angår mine bekymringer',
        'notice' => 'Der er opslag omkring :timestamp (:existing_timestamps). Vær venlig at tjekke dem inden du slår noget op.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Log ind for at svare', // Base text changed from "log" to "sign"
            'user' => 'Svar',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Marker som løst af :user',
            'false' => 'Genåbnet af :user',
        ],
    ],

    'user' => [
        'admin' => 'admin',
        'bng' => 'nominator',
        'owner' => 'mapper',
        'qat' => 'qat',
    ],
];
