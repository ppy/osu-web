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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'สร้างใหม่',
            'regenerating' => 'กำลังสร้างใหม่...',
            'remove' => 'นำออก',
            'removing' => 'กำลังนำออก...',
            'title' => '',
        ],
        'show' => [
            'covers' => 'จัดการ Beatmapset Covers',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'เปิดการใช้งาน',
                'activate_confirm' => 'เปิดการใช้งาน modding v2 สำหรับ beatmap นี้หรือไม่?',
                'active' => 'เปิดการใช้งาน',
                'inactive' => 'ปิดการใช้งาน',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'ลบ',

                'forum-name' => 'Forum #:id: :name',

                'no-cover' => 'ไม่มี cover',

                'submit' => [
                    'save' => 'บันทึก',
                    'update' => 'อัพเดต',
                ],

                'title' => 'ฟอรั่มรายการ cover',

                'type-title' => [
                    'default-topic' => 'หัวข้อ Cover เริ่มต้น',
                    'main' => 'ฟอรั่ม Cover',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'ดูบันทึกระบบ',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => '',
                'forum' => 'ฟอรั่ม',
                'general' => 'ทั่วไป',
                'store' => 'ร้านค้า',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'รายการสั่งซื้อ',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'ผู้ใช้งานคนนี้ ถูกจำกัดการใช้งาน',
            'message' => '(แอดมินเท่านั้นที่สามารถเห็นได้)',
        ],
    ],

];
