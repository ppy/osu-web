<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'เพิ่มผู้ใช้งานสู่ทีม',
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
        'members' => ':count_delimited สมาชิก|:count_delimited สมาชิก',
    ],

    'create' => [
        'submit' => 'สร้างทีม',

        'form' => [
            'name_help' => '',
            'short_name_help' => 'สูงสุด 4 ตัวอักษร',
            'title' => "ตั้งทีมใหม่กันเถอะ!",
        ],

        'intro' => [
            'description' => "",
            'title' => 'ทีม!',
        ],
    ],

    'destroy' => [
        'ok' => '',
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
            'application_help' => '',
            'default_ruleset_help' => '',
            'flag_help' => '',
            'header_help' => '',
            'title' => 'การตั้งค่าทีม',

            'application_state' => [
                'state_0' => '',
                'state_1' => '',
            ],
        ],
    ],

    'header_links' => [
        'edit' => 'การตั้งค่า',
        'leaderboard' => '',
        'show' => '',

        'members' => [
            'index' => '',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '',
    ],

    'members' => [
        'destroy' => [
            'success' => '',
        ],

        'index' => [
            'title' => '',

            'applications' => [
                'accept_confirm' => '',
                'created_at' => '',
                'empty' => '',
                'empty_slots' => '',
                'empty_slots_overflow' => '',
                'reject_confirm' => '',
                'title' => '',
            ],

            'table' => [
                'joined_at' => '',
                'remove' => '',
                'remove_confirm' => '',
                'set_leader' => '',
                'set_leader_confirm' => '',
                'status' => '',
                'title' => '',
            ],

            'status' => [
                'status_0' => '',
                'status_1' => '',
            ],
        ],

        'set_leader' => [
            'success' => '',
        ],
    ],

    'part' => [
        'ok' => 'ออกจากทีม ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'แชททีม',
            'destroy' => 'ยุบทีม',
            'join' => '',
            'join_cancel' => '',
            'part' => 'ออกจากทีม',
        ],

        'info' => [
            'created' => '',
        ],

        'members' => [
            'members' => 'สมาชิกทีม',
            'owner' => 'หัวหน้าทีม',
        ],

        'sections' => [
            'about' => '',
            'info' => '',
            'members' => '',
        ],

        'statistics' => [
            'empty_slots' => '',
            'leader' => 'หัวหน้าทีม',
            'rank' => '',
        ],
    ],

    'store' => [
        'ok' => 'สร้างทีมเรียบร้อย',
    ],
];
