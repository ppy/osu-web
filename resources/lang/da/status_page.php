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
        'description' => 'hvad sker der min ven?',
    ],

    'incidents' => [
        'title' => 'Aktive Begivenheder',
        'automated' => 'automatiseret',
    ],

    'online' => [
        'title' => [
            'users' => 'Online Brugere i de seneste 24 timer',
            'score' => 'Score Indsendelser i de seneste 24 timer',
        ],
        'current' => 'Online Brugere i Øjeblikket',
        'score' => 'Score Indsendelser i sekundet',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Seneste Begivenheder',
            'state' => [
                'resolved' => 'Løst',
                'resolving' => 'Løser',
                'unknown' => 'Ukendt',
            ],
        ],

        'uptime' => [
            'title' => 'Oppetid',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'i dag',
            'week' => 'uge',
            'month' => 'måned',
            'all_time' => 'for altid',
            'last_week' => 'sidste uge',
            'weeks_ago' => ':count uge siden|:count uger siden',
        ],
    ],
];
