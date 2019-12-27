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
    'edit' => [
        'title_compact' => 'ตั้งค่า',
        'username' => 'ชื่อผู้ใช้',

        'avatar' => [
            'title' => 'รูปโปรไฟล์',
            'rules' => '',
            'rules_link' => 'กฎของชุมชน',
        ],

        'email' => [
            'current' => 'อีเมลปัจจุบัน',
            'new' => 'อีเมลใหม่',
            'new_confirmation' => 'ยืนยันอีเมล',
            'title' => 'อีเมล',
        ],

        'password' => [
            'current' => 'รหัสผ่านปัจจุบัน',
            'new' => 'รหัสผ่านใหม่',
            'new_confirmation' => 'ยืนยันรหัสผ่าน',
            'title' => 'รหัสผ่าน',
        ],

        'profile' => [
            'title' => 'โปรไฟล์',

            'user' => [
                'user_discord' => '',
                'user_from' => 'ที่อยู่ปัจจุบัน',
                'user_interests' => 'สิ่งที่สนใจ',
                'user_msnm' => 'skype',
                'user_occ' => 'อาชีพ',
                'user_twitter' => 'ทวิตเตอร์',
                'user_website' => 'เว็บไซต์',
            ],
        ],

        'signature' => [
            'title' => 'ลายเซ็น',
            'update' => 'อัพเดต',
        ],
    ],

    'notifications' => [
        'title' => 'การแจ้งเตือน',
        'topic_auto_subscribe' => 'เปิดการแจ้งเตือนอัตโนมัติในกระทู้ที่คุณสร้างขึ้น',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'ตัวรับที่ได้รับการยืนยัน',
        'own_clients' => 'own clients',
        'title' => 'OAuth',
    ],

    'playstyles' => [
        'keyboard' => 'คีย์บอร์ด',
        'mouse' => 'เมาส์',
        'tablet' => 'แท็บเล็ต',
        'title' => 'รูปแบบการเล่น',
        'touch' => 'จอสัมผัส',
    ],

    'privacy' => [
        'friends_only' => 'บล็อกข้อความส่วนตัวจากคนที่ไม่ได้อยู่ในรายชื่อเพื่อน',
        'hide_online' => 'ซ่อนสถานะออนไลน์ของคุณ',
        'title' => 'ความเป็นส่วนตัว',
    ],

    'security' => [
        'current_session' => 'ปัจจุบัน',
        'end_session' => 'เซสชันสิ้นสุด',
        'end_session_confirmation' => 'ขั้นตอนนี้จะสิ้นสุดเซสชันของคุณในอุปกรณ์นั้นทันที คุณแน่ใจไหม?',
        'last_active' => 'ใช้งานล่าสุด:',
        'title' => 'ความปลอดภัย',
        'web_sessions' => 'เซสชันของเว็บ',
    ],

    'update_email' => [
        'update' => 'อัพเดต',
    ],

    'update_password' => [
        'update' => 'อัพเดต',
    ],

    'verification_completed' => [
        'text' => 'ตอนนี้คุณสามารถปิดแท็บ/หน้าต่างนี้ได้',
        'title' => 'การยืนยันตนสำเร็จ',
    ],

    'verification_invalid' => [
        'title' => 'ลิงก์ยืนยันตนไม่ถูกต้องหรือหมดอายุแล้ว',
    ],
];
