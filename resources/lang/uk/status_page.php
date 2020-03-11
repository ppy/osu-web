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
