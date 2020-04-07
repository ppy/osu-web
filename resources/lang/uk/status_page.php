<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'статус',
        'description' => 'що взагалі відбувається, люди?',
    ],

    'incidents' => [
        'title' => 'Поточні проблеми',
        'automated' => 'автоматично',
    ],

    'online' => [
        'title' => [
            'users' => 'Користувачів в мережі за 24 години',
            'score' => 'Очок розглянуто за 24 години',
        ],
        'current' => 'Поточний онлайн',
        'score' => 'Розглядається очок кожну секунду',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Недавні проблеми',
            'state' => [
                'resolved' => 'Вирішено',
                'resolving' => 'Вирішується',
                'unknown' => 'Невідомо',
            ],
        ],

        'uptime' => [
            'title' => 'Час роботи',
            'graphs' => [
                'server' => 'сервер',
                'web' => 'веб',
            ],
        ],

        'when' => [
            'today' => 'сьогодні',
            'week' => 'тиждень',
            'month' => 'місяць',
            'all_time' => 'весь час',
            'last_week' => 'ост. тиждень',
            'weeks_ago' => ':count тиждень назад|:count тижнів назад',
        ],
    ],
];
