<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
        'title' => 'สถานะ',
        'description' => 'เกิดอะไรขึ้น?',
    ],

    'incidents' => [
        'title' => 'เหตุการณ์ที่เกิดขึ้นอยู่',
        'automated' => 'อัตโนมัติ',
    ],

    'online' => [
        'title' => [
            'users' => 'ผู้ใช้งานออนไลน์ตั้งแต่ 24 ชั่วโมงที่แล้ว',
            'score' => 'การส่งคะแนนตั้งแต่ 24 ชั่วโมงที่แล้ว',
        ],
        'current' => 'ผู้ใช้งานออนไลน์ในขณะนี้',
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
