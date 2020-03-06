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
        'title' => 'מצב',
        'description' => 'מה קורה אחי?',
    ],

    'incidents' => [
        'title' => 'תקריות פעילות',
        'automated' => 'אוטומטי',
    ],

    'online' => [
        'title' => [
            'users' => 'משתמשים מחוברים ב- 24 שעות האחרונות',
            'score' => 'תוצאות שנשלחו ב- 24 שעות האחרונות',
        ],
        'current' => 'משתמשים מחוברים כעת',
        'score' => 'תוצאות שנשלחות כל שניה',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'תקריות אחרונות',
            'state' => [
                'resolved' => 'נפתר',
                'resolving' => 'פותר',
                'unknown' => 'לא ידוע',
            ],
        ],

        'uptime' => [
            'title' => 'זמן למעלה',
            'graphs' => [
                'server' => 'שרת',
                'web' => 'רשת',
            ],
        ],

        'when' => [
            'today' => 'היום',
            'week' => 'שבוע',
            'month' => 'חודש',
            'all_time' => 'כל הזמן',
            'last_week' => 'שבוע שעבר',
            'weeks_ago' => 'לפני :count_delimited שבוע|לפני :count_delimited שבועות',
        ],
    ],
];
