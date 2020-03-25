<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'defaults' => [
        'page_description' => 'osu! - จังหวะนั้นอยู่ห่างแค่คลิกเดียว! ด้วย Ouendan/EBA, Taiko และเกมโหมดดั้งเดิมอีกมากมาย พร้อมทั้งหน้าต่างแก้ไขที่ใช้งานได้อย่างสมบูรณ์',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'บีตแมปเซ็ท',
            'beatmapset_covers' => 'ปกหลังบีตแมปเซ็ท',
            'contest' => 'การแข่งขัน',
            'contests' => 'การแข่งขัน',
            'root' => '',
            'store_orders' => 'ผู้ดูแลระบบร้านค้า',
        ],

        'artists' => [
            'index' => 'รายการ',
        ],

        'changelog' => [
            'index' => 'รายการ',
        ],

        'help' => [
            'index' => 'หน้าแรก',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => 'ตะกร้าสินค้า',
            'orders' => 'ประวัติการสั่งซื้อ',
            'products' => 'สินค้า',
        ],

        'tournaments' => [
            'index' => '',
        ],

        'users' => [
            'modding' => '',
            'show' => 'ข้อมูล',
        ],
    ],

    'gallery' => [
        'close' => 'ปิด (กด Esc)',
        'fullscreen' => 'ปรับเป็นเต็มหน้าจอ',
        'zoom' => 'ซูมเข้า/ออก',
        'previous' => 'รูปที่แล้ว (กดลูกศรซ้าย)',
        'next' => 'รูปต่อไป (กดลูกศรขวา)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'ศิลปินโดดเด่น',
            'index' => 'รายการ',
            'packs' => 'แพ็ค',
        ],
        'community' => [
            '_' => 'ชุมชน',
            'chat' => 'แชท',
            'contests' => 'contests',
            'dev' => 'การพัฒนา',
            'forum-forums-index' => 'ฟอรั่ม',
            'getLive' => 'การถ่ายทอดสด',
            'tournaments' => 'tournaments',
        ],
        'help' => [
            '_' => 'ช่วยเหลือ',
            'getFaq' => 'คำถามที่ถามบ่อย',
            'getRules' => 'กฏ',
            'getSupport' => 'ไม่ ฉันต้องการความช่วยเหลือ จริงๆ!',
            'getWiki' => 'วิกิ',
        ],
        'home' => [
            '_' => 'หน้าแรก',
            'changelog-index' => 'บันทึกการเปลี่ยนแปลง',
            'getDownload' => 'ดาวน์โหลด',
            'news-index' => 'ข่าวสาร',
            'search' => 'ค้นหา',
            'team' => 'ทีม',
        ],
        'rankings' => [
            '_' => 'การจัดอันดับ',
            'charts' => 'ชาร์ท',
            'country' => 'ประเทศ',
            'index' => 'ประสิทธิภาพ',
            'kudosu' => 'kudosu',
            'score' => 'คะแนน',
        ],
        'store' => [
            '_' => 'ร้านค้า',
            'cart-show' => 'ตะกร้าสินค้า',
            'getListing' => 'รายการ',
            'orders-index' => 'ประวัติการสั่งซื้อ',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'ทั่วไป',
            'home' => 'หน้าแรก',
            'changelog-index' => 'บันทึกการเปลี่ยนแปลง',
            'beatmaps' => 'รายการ Beatmap',
            'download' => 'ดาวน์โหลด osu!',
        ],
        'help' => [
            '_' => 'ความช่วยเหลือและชุมชน',
            'faq' => 'คำถามที่พบบ่อย',
            'forum' => 'ฟอรัมชุมชน',
            'livestreams' => 'การถ่ายทอดสด',
            'report' => 'รายงานปัญหา',
            'wiki' => '',
        ],
        'legal' => [
            '_' => 'สถานะและกฎหมาย',
            'copyright' => 'ลิขสิทธิ์ (DMCA)',
            'privacy' => 'ความเป็นส่วนตัว',
            'server_status' => 'สถานะของเซิร์ฟเวอร์',
            'source_code' => 'รหัสต้นฉบับ',
            'terms' => 'เงื่อนไขการใช้บริการ',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'หน้าหายไป',
            'description' => "ขออภัย แต่หน้าที่คุณร้องขอไม่อยู่ที่นี่!",
        ],
        '403' => [
            'error' => "คุณไม่ควรอยู่ที่นี่",
            'description' => 'คุณอาจจะลองกลับไปนะ',
        ],
        '401' => [
            'error' => "คุณไม่ควรอยู่ที่นี่",
            'description' => 'คุณอาจจะลองกลับไปนะ หรืออาจลงชื่อเข้าใช้ดู',
        ],
        '405' => [
            'error' => 'หน้าหายไป',
            'description' => "ขออภัย แต่หน้าที่คุณร้องขอไม่อยู่ที่นี่!",
        ],
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'โอ ไม่! บางอย่างพัง! ;_;',
            'description' => "เราได้รับแจ้งโดยอัตโนมัติจากทุกข้อผิดพลาด",
        ],
        'fatal' => [
            'error' => 'โอ ไม่! บางอย่างพัง (อย่างหนัก)! ;_;',
            'description' => "เราได้รับแจ้งโดยอัตโนมัติจากทุกข้อผิดพลาด",
        ],
        '503' => [
            'error' => 'ปิดปรับปรุง!',
            'description' => "การปิดปรับปรุงส่วนมากใช้เวลาจาก 5 วินาทีถึง 10 นาที ถ้าเราปิดนานกว่า ดู :link เพื่อรายละเอียด",
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "เผื่อไว้ นี่คือโค้ตสำหรับไว้ให้ซัพพอร์ท!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "ฉันลืมรายละเอียดของฉัน",
            'password' => 'รหัสผ่าน',
            'title' => 'ลงชื่อเข้าใช้เพื่อดำเนินการต่อ',
            'username' => 'ชื่อผู้ใช้',

            'error' => [
                'email' => "ชื่อผู้ใช้หรืออีเมลไม่มีอยู่จริง",
                'password' => 'รหัสผ่านไม่ถูกต้อง',
            ],
        ],

        'register' => [
            'download' => 'ดาวน์โหลด',
            'info' => 'คุณต้องมีบัญชีครับ ทำไมคุณยังไม่มีล่ะ?',
            'title' => "ยังไม่มีมีบัญชีเหรอ?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'การตั้งค่า',
            'friends' => 'เพื่อน',
            'logout' => 'ออกจากระบบ',
            'profile' => 'โปรไฟล์ของฉัน',
        ],
    ],

    'popup_search' => [
        'initial' => 'พิมพ์เพื่อค้นหา!',
        'retry' => 'ค้นหาล้มเหลว คลิกเพื่อลองอีกครั้ง',
    ],
];
