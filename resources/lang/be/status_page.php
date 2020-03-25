<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'стан',
        'description' => 'што адбываецца, сябры?',
    ],

    'incidents' => [
        'title' => 'Актыўныя інцыдэнты',
        'automated' => 'аўтаматычна',
    ],

    'online' => [
        'title' => [
            'users' => 'Анлайн карыстальнікаў за апошнія суткі',
            'score' => 'Разгледжана ачкоў за апошнія суткі',
        ],
        'current' => 'Бягучы анлайн карыстальнікаў',
        'score' => 'Разглядаецца ачкоў кожную секунду',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Апошнія інцыдэнты',
            'state' => [
                'resolved' => 'Вырашана',
                'resolving' => 'Вырашаецца',
                'unknown' => 'Невядома',
            ],
        ],

        'uptime' => [
            'title' => 'Час працы',
            'graphs' => [
                'server' => 'сервер',
                'web' => 'вэб',
            ],
        ],

        'when' => [
            'today' => 'сёння',
            'week' => 'тыдзень',
            'month' => 'месяц',
            'all_time' => 'увесь час',
            'last_week' => 'апошні тыдзень',
            'weeks_ago' => ':count тыдзень таму|:count тыдні таму|:count тыдняў таму',
        ],
    ],
];
