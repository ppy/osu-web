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
        'title' => 'الحالة',
        'description' => 'ماذا يحدث يا صاح؟',
    ],

    'incidents' => [
        'title' => 'الأحداث الحالية',
        'automated' => 'الآليا',
    ],

    'online' => [
        'title' => [
            'users' => 'المستخدمين في الساعات ال 24 الأخيرة',
            'score' => 'نقاط البيانات في ال 24 ساعة الماضية',
        ],
        'current' => 'المستخدمين المتصلين حالياً',
        'score' => 'نقاط البيانات في الثانية',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'الأحداث مؤخراََ',
            'state' => [
                'resolved' => 'تم حله',
                'resolving' => 'يتم حَلُه',
                'unknown' => 'مجهول',
            ],
        ],

        'uptime' => [
            'title' => 'الجهوزية',
            'graphs' => [
                'server' => 'الخادم',
                'web' => 'ويب',
            ],
        ],

        'when' => [
            'today' => 'اليوم',
            'week' => 'أسبوع',
            'month' => 'شهر',
            'all_time' => 'كل الوقت',
            'last_week' => 'الأسبوع الماضي',
            'weeks_ago' => ':count_delimited منذ اسبوع |:count_delimited منذ اسابيع',
        ],
    ],
];
