<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'ดาวน์โหลดเลย',
        'online' => 'มีผู้เล่นออนไลน์ <strong>:players</strong> คน และมีห้องเล่นหลายคน <strong>:games</strong> ห้อง',
        'peak' => 'Peak, :count online users',
        'players' => 'มีผู้เล่นลงทะเบียนแล้ว <strong>:count</strong> คน',
        'title' => 'ยินดีต้อนรับ',
        'see_more_news' => 'ดูข่าวอื่นๆ เพิ่มเติม',

        'slogan' => [
            'main' => 'เกมดนตรีเล่นฟรีที่เริศที่สุดในสามโลก',
            'sub' => 'rhythm is just a click away',
        ],
    ],

    'search' => [
        'advanced_link' => 'การค้นหาขั้นสูง',
        'button' => 'ค้นหา',
        'empty_result' => 'ไม่เจออะ',
        'keyword_required' => 'ต้องการค้นหาคำหลัก',
        'placeholder' => 'หาอะไรพิมพ์ตรงนี้เลย',
        'title' => 'ค้นหา',

        'beatmapset' => [
            'login_required' => 'เข้าสู่ระบบเพื่อค้นหาบีตแมป',
            'more' => ':count more beatmap search results',
            'more_simple' => 'ดูผลการค้นหาบีทแมพเพิ่มเติม',
            'title' => 'บีทแมพ',
        ],

        'forum_post' => [
            'all' => 'ฟอรั่มทั้งหมด',
            'link' => 'ค้นหาตามฟอรัม',
            'login_required' => 'เข้าสู่ระบบเพื่อค้นหาฟอรั่ม',
            'more_simple' => 'See more forum search results',
            'title' => 'Forum',

            'label' => [
                'forum' => 'search in forums',
                'forum_children' => 'รวมฟอรัมย่อยด้วย',
                'topic_id' => 'หัวข้อ #',
                'username' => 'ผู้แต่ง',
            ],
        ],

        'mode' => [
            'all' => 'ทั้งหมด',
            'beatmapset' => 'บีตแมป',
            'forum_post' => 'ฟอรัม',
            'user' => 'ผู้เล่น',
            'wiki_page' => 'วิกิ',
        ],

        'user' => [
            'login_required' => 'เข้าสู่ระบบเพื่อค้นหาผู้ใช้',
            'more' => ':count more player search results',
            'more_simple' => 'See more player search results',
            'more_hidden' => 'ผลลัพธ์การค้นหาผู้เล่นจำกัดไว้ที่ :max คน ถ้าไม่เจอให้ลองเปลี่ยนคำค้นใหม่',
            'title' => 'ผู้เล่น',
        ],

        'wiki_page' => [
            'link' => 'ค้นหาในวิกิ',
            'more_simple' => 'See more wiki search results',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "เรามา<br>เริ่มกันเถอะ",
        'action' => 'ดาวน์โหลด osu!',
        'os' => [
            'windows' => 'สำหรับวินโดวส์',
            'macos' => 'สำหรับ macOS',
            'linux' => 'สำหรับ GNU/Linux',
        ],
        'mirror' => 'mirror',
        'macos-fallback' => 'คนใช้ macOS',
        'steps' => [
            'register' => [
                'title' => 'สร้างบัญชี',
                'description' => 'เข้าเกมแล้วทำตามที่มันบอกเพื่อเข้าสู่ระบบ หรือไปสร้างบัญชีใหม่',
            ],
            'download' => [
                'title' => 'ดาวน์โหลดเกม',
                'description' => 'กดปุ่มข้างบนเพื่อดาวน์โหลดตัวติดตั้ง โหลดเสร็จก็รันซะ',
            ],
            'beatmaps' => [
                'title' => 'ไปโหลดบีตแมป',
                'description' => [
                    '_' => ':browse the vast library of user-created beatmaps and start playing!',
                    'browse' => 'ค้นหา',
                ],
            ],
        ],
        'video-guide' => 'video guide',
    ],

    'user' => [
        'title' => 'dashboard',
        'news' => [
            'title' => 'ข่าวสาร',
            'error' => 'โหลดข่าวสารไม่ได้ ลองรีเฟรชดู เผื่อติดนะ',
        ],
        'header' => [
            'stats' => [
                'friends' => 'จำนวนเพื่อนที่ออนไลน์',
                'games' => 'เกมที่เล่นอยู่',
                'online' => 'จำนวนผู้ใช้ที่ออนไลน์',
            ],
        ],
        'beatmaps' => [
            'new' => 'Ranked Beatmaps อันใหม่',
            'popular' => 'บีตแมปยอดฮิต',
            'by_user' => 'โดย :user',
        ],
        'buttons' => [
            'download' => 'ดาวน์โหลด osu!',
            'support' => 'สนับสนุน osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'ว้าว!',
        'subtitle' => 'You seem to be having a good time! :D',
        'body' => [
            'part-1' => 'รู้หรือไม่ว่า osu! อยู่ได้โดยไม่มีโฆษณาเลย แต่จะขึ้นกับการสนับสนุนของผู้เล่นทุกคนซึ่งช่วยเรื่องการพัฒนาและค่าใช้จ่ายต่าง ๆ',
            'part-2' => 'รู้หรือไม่ว่าคุณจะได้สิทธิพิเศษเพียบเมื่อสนับสนุน osu! เช่น <strong>การดาวน์โหลดในเกม</strong> เอาไว้ใช้ตอนที่ดูคนอื่นเล่นหรือเข้าห้องเล่นหลายคน',
        ],
        'find-out-more' => 'Click here to find out more!',
        'download-starting' => "Oh, and don't worry - your download has already been started for you already ;)",
    ],
];
