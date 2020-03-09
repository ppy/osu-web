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
        'description' => 'what\'s going on mah dude?',
    ],

    'incidents' => [
        'title' => 'Aktibong insidente',
        'automated' => 'automated',
    ],

    'online' => [
        'title' => [
            'users' => 'Mga online na manlalaro sa loob ng 24 oras',
            'score' => 'Score Submissions sa loob ng 24 oras',
        ],
        'current' => 'Kasalukuyang Online Users',
        'score' => 'Mga Score Submissions kasa segundo',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Pinakabagong insidente',
            'state' => [
                'resolved' => 'Nalutas',
                'resolving' => 'Nilulutas',
                'unknown' => 'Di matukoy',
            ],
        ],

        'uptime' => [
            'title' => 'Uptime',
            'graphs' => [
                'server' => 'server',
                'web' => 'web',
            ],
        ],

        'when' => [
            'today' => 'ngayon',
            'week' => 'linggo',
            'month' => 'buwan',
            'all_time' => 'palagi',
            'last_week' => 'noong linggo',
            'weeks_ago' => ':count linggo na ang nakararaan |:count linggo ang nakalipas',
        ],
    ],
];
