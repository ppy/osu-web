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
        'none_found' => 'ไม่พบการสนทนาตามเกณฑ์การค้นหาที่เลือก',
        'title' => 'การสนทนาเกี่ยวกับบีทแมพ',

        'form' => [
            '_' => 'ค้นหา',
            'deleted' => 'รวมการสนทนาที่ถูกลบ',
            'mode' => 'โหมดของบีทแมพ',
            'only_unresolved' => 'มองเห็นเฉพาะการสนทนา/ปัญหาที่ยังไม่ได้แก้',
            'types' => 'ชนิดของข้อความ',
            'username' => 'ชื่อผู้ใช้',

            'beatmapset_status' => [
                '_' => 'สถานะบีทแมพ',
                'all' => 'ทั้งหมด',
                'disqualified' => 'ถูกตัดสิทธิ์',
                'never_qualified' => 'ไม่เคยถูก Qualified',
                'qualified' => 'Qualified',
                'ranked' => 'จัดอันดับแล้ว',
            ],

            'user' => [
                'label' => 'ผู้ใช้',
                'overview' => 'ภาพรวมกิจกรรม',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'โพสเมื่อวันที่',
        'deleted_at' => 'ถูกลบเมื่อวันที่',
        'message_type' => 'ประเภท',
        'permalink' => 'ลิงค์',
    ],

    'nearby_posts' => [
        'confirm' => 'ไม่มีโพสต์ใดกล่าวถึงปัญหาของฉัน',
        'notice' => 'มีโพสต์เมื่อเวลาประมาณ :timestamp (:existing_timestamps). โปรตตรวจสอบก่อนโพสต์',
        'unsaved' => ':count ในบทวิจารณ์นี้',
    ],

    'owner_editor' => [
        'button' => 'เจ้าของระดับความยาก',
        'reset_confirm' => 'รีเซ็ตเจ้าของสําหรับระดับความยากนี้ไหม',
        'user' => 'เจ้าของ',
        'version' => 'ระดับความยาก',
    ],

    'reply' => [
        'open' => [
            'guest' => 'เข้าสู่ระบบเพื่อตอบกลับ',
            'user' => 'ตอบกลับ',
        ],
    ],

    'review' => [
        'block_count' => 'ใช้ไป :used / :max blocks',
        'go_to_parent' => 'ดูโพสต์วิจารณ์',
        'go_to_child' => 'ดูการสนทนา',
        'validation' => [
            'block_too_large' => 'แต่ละบล็อกเก็บอักขระได้แค่ :limit อักขระ',
            'external_references' => 'บทวิจารณ์นี้มีการพูดถึงปัญหาที่ไม่เกี่ยวข้องกับบทวิจารณ์นี้',
            'invalid_block_type' => 'ชนิดของบล็อกไม่ถูกต้อง',
            'invalid_document' => 'บทวิจารณ์ไม่ถูกต้อง',
            'invalid_discussion_type' => '',
            'minimum_issues' => 'บทวิจารณ์ต้องมีปัญหาอย่างน้อย :count ปัญหา|บทวิจารณ์ต้องมีปัญหาอย่างน้อย :count ปัญหา',
            'missing_text' => 'บล็อกไม่มีข้อความ',
            'too_many_blocks' => 'บทวิจารณ์จำกัดให้มีแค่ :count ย่อหน้าต่อปัญหา|บทวิจารณ์จำกัดให้มีแค่ :count ย่อหน้าต่อหลายปัญหา',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'ทำเครื่องหมายเป็นแก้ไขแล้วโดย :user',
            'false' => 'ถูกเปิดใหม่โดย :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'ทั่วไป',
        'general_all' => 'หมวดทั่วไป (รวม)',
    ],

    'user_filter' => [
        'everyone' => 'ทุกคน',
        'label' => 'กรองโดยผู้ใช้',
    ],
];
