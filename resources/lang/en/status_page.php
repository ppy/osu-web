<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'status',
        'description' => 'whats going on mah dude?',
    ],

    'incidents' => [
        'title' => 'Active Incidents',
        'automated' => 'automated',
    ],

    'online' => [
        'title' => [
            'users' => 'Online Users in the last 24 Hours',
            'score' => 'Score Submissions in the last 24 Hours',
        ],
        'current' => 'Current Online Users',
        'score' => 'Score Submissions per Second',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Recent Incidents',
            'state' => [
                'resolved' => 'Resolved',
                'resolving' => 'Resolving',
                'unknown' => 'Unknown',
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
            'today' => 'today',
            'week' => 'week',
            'month' => 'month',
            'all_time' => 'all time',
            'last_week' => 'last week',
            'weeks_ago' => ':count_delimited week ago|:count_delimited weeks ago',
        ],
    ],
];
