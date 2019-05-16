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
        'description' => 'hva skjer min fyr?',
    ],

    'incidents' => [
        'title' => 'Aktive Hendelser',
        'automated' => 'automatisert',
    ],

    'online' => [
        'title' => [
            'users' => 'Påloggede Brukere i de siste 24 timene',
            'score' => 'Bidrag av Spillresultater i de siste 24 timene',
        ],
        'current' => 'Nåværende Påloggede Brukere',
        'score' => 'Bidrag av Spillresultater per Sekund',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Tidligere Hendelser',
            'state' => [
                'resolved' => 'Løst',
                'resolving' => 'Løser',
                'unknown' => 'Ukjent',
            ],
        ],

        'uptime' => [
            'title' => 'Driftstid',
            'graphs' => [
                'server' => 'server',
                'web' => 'nett',
            ],
        ],

        'when' => [
            'today' => 'i dag',
            'week' => 'uke',
            'month' => 'måned',
            'all_time' => 'all tid',
            'last_week' => 'forrige uke',
            'weeks_ago' => ':count_delimited uke siden|:count_delimited uker siden',
        ],
    ],
];
