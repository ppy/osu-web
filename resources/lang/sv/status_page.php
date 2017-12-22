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
    'header' => [
        'title' => 'status',
        'description' => 'vad händer mah dude?',
    ],

    'incidents' => [
        'title' => 'Aktiva Incidenter',
        'automated' => 'automatiserad',
    ],

    'online' => [
        'title' => [
            'users' => 'Användare Online dem senaste 24 timmarna',
            'score' => 'Poäng Inlämningar dem senaste 24 timmarna',
        ],
        'current' => 'Nuvarande Användare Online',
        'score' => 'Poäng Inlämningar per Sekund',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Senaste Incidenter',
            'state' => [
                'resolved' => 'Löst',
                'resolving' => 'Lösande',
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
            'last_week' => 'senaste vecka',
            'weeks_ago' => ':count vecka sedan|:count veckor sedan',
        ],
    ],
];
