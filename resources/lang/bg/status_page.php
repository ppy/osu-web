<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
