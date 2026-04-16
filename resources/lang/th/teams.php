<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'เพิ่มผู้ใช้เข้าสู่ทีมสำเร็จ',
        ],
        'destroy' => [
            'ok' => 'ยกเลิกการขอเข้าร่วมแล้ว',
        ],
        'reject' => [
            'ok' => 'ปฎิเสธการขอเข้าร่วมแล้ว',
        ],
        'store' => [
            'ok' => 'ขอร้องขอเข้าร่วมทีมแล้ว',
        ],
    ],

    'card' => [
        'members' => ':count_delimited คน|:count_delimited คน',
    ],

    'create' => [
        'submit' => 'สร้างทีม',

        'form' => [
            'name_help' => 'ชื่อทีมของคุณ ตอนนี้ไม่สามารถเปลี่ยนได้',
            'short_name_help' => 'สูงสุด 4 ตัวอักษร',
            'title' => "ตั้งทีมใหม่กันเถอะ!",
        ],

        'intro' => [
            'description' => "เล่นกับเพื่อน จะเพื่อนเก่าหรือเพื่อนใหม่ ตอนนี้คุณยังไม่มีทีมอยู่ จะเข้าร่วมทีมคนอื่นจากหน้าทีมของพวกเขา หรือสร้างทีมใหม่ได้จากหน้านี้ก็ได้",
            'title' => 'ทีม!',
        ],
    ],

    'destroy' => [
        'ok' => 'ลบทีมออกแล้ว',
    ],

    'edit' => [
        'ok' => 'บันทึกการตั้งค่าเรียบร้อยแล้ว',
        'title' => 'การตั้งค่าทีม',

        'description' => [
            'label' => 'รายละเอียด',
            'title' => 'รายละเอียดกลุ่ม',
        ],

        'flag' => [
            'label' => 'ธงทีม',
            'title' => 'ตั้งธงทีม',
        ],

        'header' => [
            'label' => 'รูปภาพส่วนหัว',
            'title' => 'ตั้งค่ารูปภาพส่วนหัว',
        ],

        'settings' => [
            'application_help' => 'อนุญาตให้มีคนขอเข้าทีม',
            'default_ruleset_help' => 'รูลเซ็ตที่จะถูกเลือกเมื่อดูหน้าทีม',
            'flag_help' => 'ขนาดสูงสุด :widthx:height',
            'header_help' => 'ขนาดสูงสุด :widthx:height',
            'title' => 'การตั้งค่าทีม',

            'application_state' => [
                'state_0' => 'ไม่รับคนเข้าทีม',
                'state_1' => 'รับคนเข้าทีม',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'การตั้งค่า',
        'leaderboard' => 'กระดานผู้นำ',
        'show' => 'ข้อมูล',

        'members' => [
            'index' => 'จัดการสมาชิก',
        ],
    ],

    'leaderboard' => [
        'global_rank' => 'อันดับโลก',
    ],

    'members' => [
        'destroy' => [
            'success' => 'ลบสมาชิกทีมสำเร็จ',
        ],

        'index' => [
            'title' => 'จัดการสมาชิก',

            'applications' => [
                'accept_confirm' => 'เพิ่มผู้ใช้ :user เข้าสู่ทีมหรือไม่?',
                'created_at' => 'วันที่ขอเข้าทีม',
                'empty' => 'ไม่มีคำขอเข้าทีม',
                'empty_slots' => 'ที่ว่าง',
                'empty_slots_overflow' => 'เกิน :count_delimited คน|เกิน :count_delimited คน',
                'reject_confirm' => 'ปฏิเสธคำขอเข้าทีมจากผู้ใช้ :user หรือไม่?',
                'title' => 'คำขอเข้าร่วม',
            ],

            'table' => [
                'joined_at' => 'วันที่เข้าทีม',
                'remove' => 'ลบออก',
                'remove_confirm' => 'ลบผู้ใช้ :user ออกจากทีมหรือไม่',
                'set_leader' => 'มอบตำแหน่งหัวหน้าทีม',
                'set_leader_confirm' => 'มอบตำแหน่งหัวหน้าทีมให้กับผู้ใช้ :user หรือไม่?',
                'status' => 'สถานะ',
                'title' => 'สมาชิกในตอนนี้',
            ],

            'status' => [
                'status_0' => 'ออฟไลน์',
                'status_1' => 'ออนไลน์',
            ],
        ],

        'set_leader' => [
            'success' => 'ผู้ใช้ :user กลายเป็นหัวหน้าทีมแล้ว',
        ],
    ],

    'part' => [
        'ok' => 'ออกจากทีมไปแล้ว ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'แชททีม',
            'destroy' => 'ยุบทีม',
            'join' => 'ขอเข้าร่วม',
            'join_cancel' => 'ยกเลิกการเข้าร่วม',
            'part' => 'ออกจากทีม',
        ],

        'info' => [
            'created' => 'วันที่ก่อตั้ง',
        ],

        'members' => [
            'members' => 'สมาชิกทีม',
            'owner' => 'หัวหน้าทีม',
        ],

        'sections' => [
            'about' => 'เกี่ยวกับเรา!',
            'info' => 'ข้อมูล',
            'members' => 'สมาชิก',
        ],

        'statistics' => [
            'empty_slots' => 'ว่าง :count_delimited ที่|ว่าง :count_delimited ที่',
            'first_places' => 'ที่หนึ่ง',
            'leader' => 'หัวหน้าทีม',
            'rank' => 'อันดับ',
            'ranked_beatmapsets' => 'บีทแมพที่จัดอันดับแล้ว',
        ],
    ],

    'store' => [
        'ok' => 'สร้างทีมเรียบร้อย',
    ],
];
