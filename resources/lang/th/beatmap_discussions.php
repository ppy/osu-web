<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'ต้องเข้าสู่ระบบก่อนจะแก้ไข',
            'system_generated' => 'ไม่สามารถแก้ไขโพสต์ที่ระบบสร้างขึ้นเองได้',
            'wrong_user' => 'ต้องเป็นเจ้าของโพสต์นี้ถึงจะสามารถแก้ไขได้',
        ],
    ],

    'events' => [
        'empty' => 'อืม... ยังไม่มีอะไรเกิดขึ้น',
    ],

    'index' => [
        'deleted_beatmap' => 'ถูกลบไปแล้ว',
        'none_found' => '',
        'title' => 'การสนทนาเกี่ยวกับ Beatmap',

        'form' => [
            '_' => 'ค้นหา',
            'deleted' => 'รวมการสนทนาที่ถูกลบ',
            'only_unresolved' => 'มองเห็นเฉพาะการสนทนา/ปัญหาที่ยังไม่ได้แก้',
            'types' => 'ชนิดของข้อความ',
            'username' => 'ชื่อผู้ใช้',

            'beatmapset_status' => [
                '_' => 'สถานะบีตแมป',
                'all' => 'ทั้งหมด',
                'disqualified' => 'คัดออกแล้ว',
                'never_qualified' => 'ไม่เคยถูกคัดออก',
                'qualified' => 'ผ่านเกณฑ์',
                'ranked' => 'ถูกจัดอันดับแล้ว',
            ],

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

    'review' => [
        'go_to_parent' => 'ดูโพสต์รีวิว',
        'go_to_child' => 'ดูการสนทนา',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'ทำเครื่องหมายเป็นแก้ไขแล้วโดย :user',
            'false' => 'ถูกเปิดใหม่โดย :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'ทุกคน',
        'label' => 'กรองโดยผู้ใช้',
    ],
];
