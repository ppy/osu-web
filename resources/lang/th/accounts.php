<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'การตั้งค่า',
        'username' => 'ชื่อผู้ใช้',

        'avatar' => [
            'title' => 'รูปโปรไฟล์',
            'rules' => 'โปรดตรวจสอบให้แน่ใจว่า avatar ของคุณเป็นไปตาม :link.<br/> ซึ่งหมายความว่ามันจะต้องเป็น <strong> เหมาะสำหรับทุกวัย </strong> เช่น ไม่มีภาพลามกหยาบคายหรือเนื้อหาที่มีการชักจูง',
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
                'user_occ' => 'อาชีพ',
                'user_twitter' => '',
                'user_website' => 'เว็บไซต์',
            ],
        ],

        'signature' => [
            'title' => 'ลายเซ็น',
            'update' => 'อัพเดต',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => 'ได้รับการแจ้งเตือนเกียวกับปัญหาของ Qualified beatmaps กับโหมดต่อไปนี้',
        'beatmapset_disqualify' => 'ได้รับการแจ้งเตือนเมื่อบีทแมพในโหมดที่ท่านเลือกถูกตัดสิทธิ์',
        'comment_reply' => 'รับการแจ้งเตือนสำหรับการตอบกลับความคิดเห็นของคุณ',
        'title' => 'การแจ้งเตือน',
        'topic_auto_subscribe' => 'เปิดการแจ้งเตือนอัตโนมัติในกระทู้ที่คุณสร้างขึ้น',

        'options' => [
            '_' => 'วิธีการรับการแจ้งเตือน',
            'beatmap_owner_change' => '',
            'beatmapset:modding' => 'การวิจารณ์บีทแมพ',
            'channel_message' => 'ข้อความส่วนตัว',
            'comment_new' => 'ความคิดเห็นใหม่',
            'forum_topic_reply' => 'ข้อความตอบกลับในกระทู้',
            'mail' => 'อีเมล',
            'mapping' => 'ผู้ทำบีทแมพ',
            'push' => 'ส่งการแจ้งเตือน',
            'user_achievement_unlock' => 'ผู้เล่นได้ปลดล็อกเหรียญตรา',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'client ที่ได้รับการยืนยัน',
        'own_clients' => 'client ของตนเอง',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ซ่อนคำเตือนเกี่ยวกับเนื้อหาที่ล่อแหลมในบีทแมพ',
        'beatmapset_title_show_original' => 'แสดงข้อมูลของ บีทแมพ ในภาษาดั้งเดิม',
        'title' => 'ตัวเลือก',

        'beatmapset_download' => [
            '_' => 'ประเภทการดาวน์โหลดบีทแมพเริ่มต้น',
            'all' => 'พร้อมวิดีโอ ถ้าใช้ได้',
            'direct' => 'เปิดใน osu!direct',
            'no_video' => 'โดยที่ไม่มีวิดีโอ',
        ],
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
        'end_session' => 'สิ้นสุดเซสชัน',
        'end_session_confirmation' => 'ขั้นตอนนี้จะสิ้นสุดเซสชันของคุณในอุปกรณ์นั้นทันที คุณแน่ใจไหม?',
        'last_active' => 'ใช้งานล่าสุด:',
        'title' => 'ความปลอดภัย',
        'web_sessions' => 'เซสชั่นของเว็บ',
    ],

    'update_email' => [
        'update' => 'อัปเดต',
    ],

    'update_password' => [
        'update' => 'อัปเดต',
    ],

    'verification_completed' => [
        'text' => 'ตอนนี้คุณสามารถปิดแท็บ/หน้าต่างนี้ได้',
        'title' => 'การยืนยันตัวตนสำเร็จ',
    ],

    'verification_invalid' => [
        'title' => 'ลิงก์ยืนยันตนไม่ถูกต้องหรือหมดอายุแล้ว',
    ],
];
