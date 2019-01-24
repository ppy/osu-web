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
