<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'статус',
        'description' => 'какво се случва мой човек?',
    ],

    'incidents' => [
        'title' => 'Активни проблеми',
        'automated' => 'автоматизирано',
    ],

    'online' => [
        'title' => [
            'users' => 'Потребители онлайн за последните 24 часа',
            'score' => 'Публикации на резултати за последните 24 часа',
        ],
        'current' => 'Текущи потребители онлайн',
        'score' => 'Публикации на резултати на секунда',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'Скорошни проблеми',
            'state' => [
                'resolved' => 'Разрешени',
                'resolving' => 'В процес на разрешаване',
                'unknown' => 'Неизвестен',
            ],
        ],

        'uptime' => [
            'title' => 'Време на работа',
            'graphs' => [
                'server' => 'сървър',
                'web' => 'уеб',
            ],
        ],

        'when' => [
            'today' => 'днес',
            'week' => 'седмица',
            'month' => 'месец',
            'all_time' => 'за всички времена',
            'last_week' => 'за последната седмица',
            'weeks_ago' => 'преди :count седмица | преди :count седмици',
        ],
    ],
];
