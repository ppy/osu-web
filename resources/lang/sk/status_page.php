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
        'title' => 'stav',
        'description' => 'čo sa deje kámo?',
    ],

    'incidents' => [
        'title' => 'Aktívne Incidenty',
        'automated' => 'automatizovaný',
    ],

    'online' => [
        'title' => [
            'users' => 'Online užívatelia za posledných 24 hodín',
            'score' => 'Predložené skóre za posledných 24 hodín',
        ],
        'current' => 'Aktuálni Online Užívatelia',
        'score' => 'Odoslaných Skóre za Sekundu',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Nedávne Incidenty',
            'state' => [
                'resolved' => 'Vyriešené',
                'resolving' => 'Riešenie',
                'unknown' => 'Neznáme',
            ],
        ],

        'uptime' => [
            'title' => 'Doba prevozu',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'dnes',
            'week' => 'týždeň',
            'month' => 'mesiac',
            'all_time' => 'vždy',
            'last_week' => 'posledný týždeň',
            'weeks_ago' => 'pred:count týždňom|pred:count týždňami',
        ],
    ],
];
