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
        'description' => 'vad händer mina bekanta?',
    ],

    'incidents' => [
        'title' => 'Aktiva Incidenter',
        'automated' => 'automatiserad',
    ],

    'online' => [
        'title' => [
            'users' => 'Användare Online de senaste 24 timmarna',
            'score' => 'Poäng Inlämningar de senaste 24 timmarna',
        ],
        'current' => 'Nuvarande Användare Online',
        'score' => 'Poäng Inlämningar per Sekund',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Senaste Incidenter',
            'state' => [
                'resolved' => 'Löst',
                'resolving' => 'Skickar förfrågan',
                'unknown' => 'Okänd',
            ],
        ],

        'uptime' => [
            'title' => 'Upptid',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'idag',
            'week' => 'vecka',
            'month' => 'månad',
            'all_time' => 'all tid',
            'last_week' => 'förra veckan',
            'weeks_ago' => ':count vecka sedan|:count veckor sedan',
        ],
    ],
];
