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
