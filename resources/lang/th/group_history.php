<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'ไม่พบประวัติกลุ่ม!',
    'view' => 'ดูประวัติกลุ่ม',

    'event' => [
        'actor' => 'โดย :user',

        'message' => [
            'group_add' => 'สร้าง :group แล้ว',
            'group_remove' => 'ลบ :group แล้ว',
            'group_rename' => ':previous_group เปลี่ยนชื่อเป็น :group แล้ว',
            'user_add' => 'เพิ่ม :user เข้า :group แล้ว',
            'user_add_with_playmodes' => 'เพิ่ม :user เข้า :group สำหรับ :rulesets แล้ว',
            'user_add_playmodes' => 'เพิ่ม :rulesets ไปในการเป็นสมาชิก :group ของ :user แล้ว',
            'user_remove' => 'ลบ :user ออกจาก :group แล้ว',
            'user_remove_playmodes' => 'ลบ :rulesets ออกไปในการเป็นสมาชิก :group ของ :user แล้ว',
            'user_set_default' => 'เปลี่ยนกลุ่มปกติของ :user เป็น :group',
        ],
    ],

    'form' => [
        'group' => 'กลุ่ม',
        'group_all' => 'ทุกกลุ่ม',
        'max_date' => 'ถึง',
        'min_date' => 'ตั้งแต่',
        'user' => 'ผู้ใช้',
        'user_prompt' => 'ชื่อผู้ใช้ หรือ ID',
    ],

    'staff_log' => [
        '_' => 'ประวัติกลุ่มเก่าๆ ดูได้ใน :wiki_articles',
        'wiki_articles' => 'บทความประวัติสตาฟในวิกิ',
    ],
];
