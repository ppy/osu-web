<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'статус',
        'description' => 'что вообще происходит, ребят?',
    ],

    'incidents' => [
        'title' => 'Текущие проблемы',
        'automated' => 'автоматически',
    ],

    'online' => [
        'title' => [
            'users' => 'Пользователей в сети за 24 часа',
            'score' => 'Очков рассмотрено за 24 часа',
        ],
        'current' => 'Текущий онлайн',
        'score' => 'Рассматривается очков каждую секунду',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Недавние проблемы',
            'state' => [
                'resolved' => 'Решено',
                'resolving' => 'Решается',
                'unknown' => 'Неизвестно',
            ],
        ],

        'uptime' => [
            'title' => 'Аптайм',
            'graphs' => [
                'server' => 'сервер',
                'web' => 'веб',
            ],
        ],

        'when' => [
            'today' => 'сегодня',
            'week' => 'неделя',
            'month' => 'месяц',
            'all_time' => 'всё время',
            'last_week' => 'последняя неделя',
            'weeks_ago' => ':count неделю назад|:count недели назад|:count недель назад',
        ],
    ],
];
