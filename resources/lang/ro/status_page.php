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
    'header' => [
        'title' => 'status',
        'description' => 'ce se întamplă, omul meu?',
    ],

    'incidents' => [
        'title' => 'Incidente active',
        'automated' => 'automatizat',
    ],

    'online' => [
        'title' => [
            'users' => 'Utilizatori online în ultimele 24 de ore',
            'score' => 'Numărul de scoruri trimise în ultimele 24 de ore',
        ],
        'current' => 'Utilizatori online',
        'score' => 'Numărul de scoruri trimise pe secundă',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Incidente recente',
            'state' => [
                'resolved' => 'Rezolvat',
                'resolving' => 'Se rezolvă',
                'unknown' => 'Necunoscut',
            ],
        ],

        'uptime' => [
            'title' => 'Timpul de funcționare',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'astăzi',
            'week' => 'saptămână',
            'month' => 'lună',
            'all_time' => 'tot timpul',
            'last_week' => 'ultima săptămână',
            'weeks_ago' => ':count săptămână în urmă|:count săptămâni în urmă',
        ],
    ],
];
