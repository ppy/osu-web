<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'ดาวน์โหลดเลย',
        'online' => 'มีผู้เล่นออนไลน์ <strong>:players</strong> คน และมีห้องเล่นหลายคน <strong>:games</strong> ห้อง',
        'peak' => 'ผู้เล่นออนไลน์สูงสุด :count คน',
        'players' => 'มีผู้เล่นลงทะเบียนแล้ว <strong>:count</strong> คน',
        'title' => 'ยินดีต้อนรับ',
        'see_more_news' => 'ดูข่าวอื่น ๆ เพิ่มเติม',

        'slogan' => [
            'main' => 'เกมดนตรีเล่นฟรีที่เริศที่สุดในสามโลก',
            'sub' => 'rhythm is just a click away',
        ],
    ],

    'search' => [
        'advanced_link' => 'การค้นหาขั้นสูง',
        'button' => 'ค้นหา',
        'empty_result' => 'ไม่พบสิ่งใด!',
        'keyword_required' => 'จำเป็นต้องมีคำค้นหา',
        'placeholder' => 'พิมพ์เพื่อค้นหา',
        'title' => 'ค้นหา',

        'beatmapset' => [
            'login_required' => 'เข้าสู่ระบบเพื่อค้นหาบีทแมพ',
            'more' => ':count ผลการค้นหาบีทแมพเพิ่มเติม',
            'more_simple' => 'ดูผลการค้นหาบีทแมพเพิ่มเติม',
            'title' => 'บีทแมพ',
        ],

        'forum_post' => [
            'all' => 'ฟอรั่มทั้งหมด',
            'link' => 'ค้นหาตามฟอรั่ม',
            'login_required' => 'เข้าสู่ระบบเพื่อค้นหาฟอรั่ม',
            'more_simple' => 'ดูผลการค้นหาฟอรั่มเพิ่มเติม',
            'title' => 'ฟอรั่ม',

            'label' => [
                'forum' => 'ค้นหาในฟอรั่ม',
                'forum_children' => 'รวมฟอรั่มย่อย',
                'topic_id' => 'หัวข้อ #',
                'username' => 'ผู้แต่ง',
            ],
        ],

        'mode' => [
            'all' => 'ทั้งหมด',
            'beatmapset' => 'บีทแมพ',
            'forum_post' => 'ฟอรั่ม',
            'user' => 'ผู้เล่น',
            'wiki_page' => 'วิกิ',
        ],

        'user' => [
            'login_required' => 'เข้าสู่ระบบเพื่อค้นหาผู้ใช้',
            'more' => ':count ผลการค้นหาผู้เล่นเพิ่มเติม',
            'more_simple' => 'ดูผลการค้นหาผู้เล่นเพิ่มเติม',
            'more_hidden' => 'ผลลัพธ์การค้นหาผู้เล่นจำกัดไว้ที่ :max คน ลองเปลี่ยนคำค้นใหม่',
            'title' => 'ผู้เล่น',
        ],

        'wiki_page' => [
            'link' => 'ค้นหาในวิกิ',
            'more_simple' => 'ดูผลการค้นหาวิกิเพิ่มเติม',
            'title' => 'วิกิ',
        ],
    ],

    'download' => [
        'tagline' => "เรามา<br>เริ่มกันเถอะ",
        'action' => 'ดาวน์โหลด osu!',

        'help' => [
            '_' => 'ถ้ามีปัญหาในการเข้าเกมหรือสมัครบัญชีสามารถหาความช่วยเหลือได้ที่ :help_forum_link หรือ :support_button',
            'help_forum_link' => 'เช็คฟอรั่มช่วยเหลือ',
            'support_button' => 'ติดต่อฝ่ายช่วยเหลือ',
        ],

        'os' => [
            'windows' => 'สำหรับวินโดวส์',
            'macos' => 'สำหรับ macOS',
            'linux' => 'สำหรับ Linux',
        ],
        'mirror' => 'เซิร์ฟเวอร์อื่น',
        'macos-fallback' => 'ผู้ใช้ macOS',
        'steps' => [
            'register' => [
                'title' => 'สร้างบัญชี',
                'description' => 'เข้าเกมแล้วทำตามลำดับที่บอกเพื่อเข้าสู่ระบบหรือสร้างบัญชีใหม่',
            ],
            'download' => [
                'title' => 'ดาวน์โหลดเกม',
                'description' => 'กดปุ่มข้างบนเพื่อดาวน์โหลดตัวติดตั้งและรัน',
            ],
            'beatmaps' => [
                'title' => 'โหลดบีทแมพ',
                'description' => [
                    '_' => ':browse บีทแมพมากมายที่ผู้เล่นต่าง ๆ ได้สร้างขึ้น และเริ่มเล่น!',
                    'browse' => 'ค้นหา',
                ],
            ],
        ],
        'video-guide' => 'ไกด์วิดิโอ',
    ],

    'user' => [
        'title' => 'หน้าหลัก',
        'news' => [
            'title' => 'ข่าวสาร',
            'error' => 'โหลดข่าวสารไม่ได้ ลองรีเฟรชหน้านี้?..',
        ],
        'header' => [
            'stats' => [
                'friends' => 'จำนวนเพื่อนที่ออนไลน์',
                'games' => 'เกมที่เล่นอยู่',
                'online' => 'จำนวนผู้ใช้ที่ออนไลน์',
            ],
        ],
        'beatmaps' => [
            'new' => 'บีทแมพจัดอันดับใหม่ล่าสุด',
            'popular' => 'บีทแมพยอดฮิต',
            'by_user' => 'โดย :user',
        ],
        'buttons' => [
            'download' => 'ดาวน์โหลด osu!',
            'support' => 'สนับสนุน osu!',
            'store' => 'osu!store',
        ],
    ],
];
