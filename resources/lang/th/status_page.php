<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'title' => 'สถานะ',
        'description' => 'แก ๆ เกิดอะไรขึ้นอะ',
    ],

    'incidents' => [
        'title' => 'เหตุการณ์ที่เกิดขึ้นอยู่',
        'automated' => 'อัตโนมัติ',
    ],

    'online' => [
        'title' => [
            'users' => 'ผู้ใช้ที่ออนไลน์ในรอบ 24 ชั่วโมง',
            'score' => 'การส่งคะแนนในรอบ 24 ชั่วโมง',
        ],
        'current' => 'ผู้ใช้ที่ออนไลน์ในขณะนี้',
        'score' => 'จำนวนการส่งคะแนนต่อวินาที',
    ],

    'recent' => [
        'incidents' => [
            'title' => 'เหตุการณ์ที่เกิดขึ้นล่าสุด',
            'state' => [
                'resolved' => 'แก้ไขแล้ว',
                'resolving' => 'กำลังแก้ไข',
                'unknown' => 'ไม่ทราบสถานะ',
            ],
        ],

        'uptime' => [
            'title' => 'ระยะเวลาที่ให้บริการ',
            'graphs' => [
                'server' => 'เซิร์ฟเวอร์',
                'web' => 'เว็บไซต์',
            ],
        ],

        'when' => [
            'today' => 'วันนี้',
            'week' => 'สัปดาห์',
            'month' => 'เดือน',
            'all_time' => 'ตลอดเวลา',
            'last_week' => 'สัปดาห์ที่แล้ว',
            'weeks_ago' => ':count สัปดาห์ที่แล้ว|:count สัปดาห์ที่แล้ว',
        ],
    ],
];
