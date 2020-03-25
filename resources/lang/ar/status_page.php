<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
