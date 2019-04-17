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
        'description' => 'co se děje kámo?',
    ],

    'incidents' => [
        'title' => 'Aktivní incidenty',
        'automated' => 'automatizovaný',
    ],

    'online' => [
        'title' => [
            'users' => 'Online uživatelé za posledních 24 hodin',
            'score' => 'Předložená skóre za posledních 24 hodin',
        ],
        'current' => 'Aktuálně online uživatelé',
        'score' => 'Odeslaných skóre za sekundu',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Nedávné incidenty',
            'state' => [
                'resolved' => 'Vyřešeno',
                'resolving' => 'Řešení',
                'unknown' => 'Neznámé',
            ],
        ],

        'uptime' => [
            'title' => 'Doba provozu',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'dnes',
            'week' => 'týden',
            'month' => 'měsíc',
            'all_time' => 'za celou dobu',
            'last_week' => 'poslední týden',
            'weeks_ago' => 'před :count týdnem|před :count týdny',
        ],
    ],
];
