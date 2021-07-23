<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'ไม่สามารถส่งข้อความที่ว่างเปล่าได้.',
            'limit_exceeded' => 'คุณส่งข้อความเร็วเกินไป กรุณารอสักครู่แล้วลองใหม่',
            'too_long' => 'ข้อความที่คุณพยายามส่งนั้นยาวเกินไป',
        ],
    ],

    'scopes' => [
        'bot' => 'ทำตัวคล้ายแชทบอต',
        'identify' => 'ระบุตัวตนของคุณ และอ่านโปรไฟล์สาธารณะของคุณ',

        'chat' => [
            'write' => 'ส่งข้อความในนามของคุณ',
        ],

        'forum' => [
            'write' => 'สร้างและแก้ไขหัวข้อโพสต์ของฟอรั่มในนามของคุณ',
        ],

        'friends' => [
            'read' => 'ดูคนที่คุณกำลังติดตาม',
        ],

        'public' => 'มอบฉันทะในการเข้าถึงข้อมูลสาธารณะให้กับบุคคลอื่น',
    ],
];
