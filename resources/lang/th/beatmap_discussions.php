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
    'authorizations' => [
        'update' => [
            'null_user' => 'ต้องเข้าสู่ระบบก่อนจะแก้ไข',
            'system_generated' => 'โพสต์ที่ถูกสร้างขึ้นเองจากระบบไม่สามารถถูกแก้ไขได้',
            'wrong_user' => 'ต้องเป็นเจ้าของโพสนี้ถึงจะสามารถแก้ไขได้',
        ],
    ],

    'events' => [
        'empty' => 'ยังไม่มีอะไรเกิดขึ้น...ยัง',
    ],

    'index' => [
        'deleted_beatmap' => 'ถูกลบไปแล้ว',
        'title' => 'การสนทนาเกี่ยวกับ Beatmap',

        'form' => [
            '_' => 'ค้นหา',
            'deleted' => 'รวมการสนทนาที่ถูกลบ',
            'types' => 'ชนิดของข้อความ',
            'username' => 'ชื่อผู้ใช้',

            'user' => [
                'label' => 'ผู้ใช้',
                'overview' => 'ภาพรวมกิจกรรม',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'วันโพสต์',
        'deleted_at' => 'วันที่ถูกลบ',
        'message_type' => 'ประเภท',
        'permalink' => 'ลิงก์ถาวร',
    ],

    'nearby_posts' => [
        'confirm' => 'ไม่มีโพสต์ใดกล่าวถึงปัญหาของฉัน',
        'notice' => 'มีโพสต์เมื่อเวลาประมาณ :timestamp (:existing_timestamps). โปรตตรวจสอบก่อนโพสต์',
    ],

    'reply' => [
        'open' => [
            'guest' => 'เข้าสู่ระบบเพื่อตอบกลับ',
            'user' => 'ตอบกลับ',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'ทำเครื่องหมายเป็นแก้ไขแล้วโดย :user',
            'false' => 'ถูกเปิดใหม่โดย :user',
        ],
    ],

    'user' => [
        'admin' => 'ผู้ดูแล',
        'bng' => 'ผู้เสนอชื่อ',
        'owner' => 'ผู้ทำแมพ',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => 'ทุกคน',
        'label' => 'กรองโดยผู้ใช้',
    ],
];
