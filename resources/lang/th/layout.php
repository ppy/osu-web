<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'defaults' => [
        'page_description' => 'osu! - จังหวะนั้นอยู่ห่างแค่คลิกเดียว! ด้วย Ouendan/EBA, Taiko และเกมโหมดดั้งเดิมอีกมากมาย พร้อมทั้งหน้าต่างแก้ไขที่ใช้งานได้อย่างสมบูรณ์',
    ],

    'menu' => [
        'home' => [
            '_' => 'หน้าแรก',
            'account-edit' => 'การตั้งค่า',
            'friends-index' => 'เพื่อน',
            'changelog-index' => 'บันทึกการเปลี่ยนแปลง',
            'changelog-build' => '',
            'getDownload' => 'ดาวน์โหลด',
            'getIcons' => 'ไอคอน',
            'groups-show' => 'กลุ่ม',
            'index' => 'หน้าหลัก',
            'legal-show' => 'ข้อมูล',
            'news-index' => 'ข่าวสาร',
            'news-show' => 'ข่าวสาร',
            'password-reset-index' => 'รีเซ็ตรหัสผ่าน',
            'search' => 'ค้นหา',
            'supportTheGame' => 'สนับสนุนเกม',
            'team' => 'ทีม',
        ],
        'help' => [
            '_' => 'ช่วยเหลือ',
            'getFaq' => 'คำถามที่ถามบ่อย',
            'getRules' => 'กฏ',
            'getSupport' => 'ไม่ ฉันต้องการความช่วยเหลือ จริงๆ!',
            'getWiki' => 'วิกิ',
            'wiki-show' => 'วิกิ',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'featured artists',
            'beatmap_discussion_posts-index' => 'โพสต์การสนทนาเกี่ยวกับ Beatmap',
            'beatmap_discussions-index' => 'การสนทนาเกี่ยวกับ Beatmap',
            'beatmapset-watches-index' => 'รายการ Mod ที่ติดตาม',
            'beatmapset_discussion_votes-index' => 'โหวตการสนทนา Beatmap',
            'beatmapset_events-index' => 'กิจกรรมของ Beatmapset',
            'index' => 'รายการ',
            'packs' => 'แพ็ค',
            'show' => 'ข้อมูล',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'การจัดอันดับ',
            'index' => 'ประสิทธิภาพ',
            'performance' => 'ประสิทธิภาพ',
            'charts' => 'ชาร์ท',
            'score' => 'คะแนน',
            'country' => 'ประเทศ',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'ชุมชน',
            'dev' => 'พัฒนาการ',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getLive' => 'live',
            'contests' => 'contests',
            'profile' => 'profile',
            'tournaments' => 'tournaments',
            'tournaments-index' => 'ทัวร์นาเม้นท์',
            'tournaments-show' => 'ข้อมูลทัวร์นาเมนต์',
            'forum-topic-watches-index' => 'การ​สมัคร​สมาชิก',
            'forum-topics-create' => 'ฟอรั่ม',
            'forum-topics-show' => 'ฟอรั่ม',
            'forum-forums-index' => 'ฟอรั่ม',
            'forum-forums-show' => 'ฟอรั่ม',
        ],
        'multiplayer' => [
            '_' => 'โหมดผู้เล่นหลายคน',
            'show' => 'จับคู่',
        ],
        'error' => [
            '_' => 'ข้อผิดพลาด',
            '404' => 'หายไป',
            '403' => 'ต้องห้าม',
            '401' => 'ไม่ได้รับอนุญาต',
            '405' => 'หายไป',
            '500' => 'อะไรสักอย่างพัง',
            '503' => 'การบำรุงรักษาระบบ',
        ],
        'user' => [
            '_' => 'ผู้ใช้',
            'getLogin' => 'ลงชื่อเข้าใช้',
            'disabled' => 'ปิดการใช้งาน',

            'register' => 'สมัครสมาชิก',
            'reset' => 'กู้คืน',
            'new' => 'ใหม่',

            'messages' => 'ข้อความ',
            'settings' => 'การตั้งค่า',
            'logout' => 'ออกจากระบบ',
            'help' => 'ช่วยเหลือ',
            'modding-history-discussions' => 'การสนทนาการ Mod ของผู้ใช้',
            'modding-history-events' => 'กิจกรรมการ Mod ของผู้ใช้',
            'modding-history-index' => 'ประวัติการ Mod ของผู้ใช้',
            'modding-history-posts' => 'โพสต์การ Mod ของผู้ใช้',
            'modding-history-votesGiven' => 'โหวตการ Mod ที่ถูกให้',
            'modding-history-votesReceived' => 'โหวตการ Mod ที่ได้รับ',
        ],
        'store' => [
            '_' => 'ร้านค้า',
            'checkout-show' => 'จบการยืนยัน',
            'getListing' => 'รายการ',
            'cart-show' => 'ตะกร้าสินค้า',

            'getCheckout' => 'ชำระเงิน',
            'getInvoice' => 'ใบกำกับสินค้า',
            'products-show' => 'สินค้า',

            'new' => 'ใหม่',
            'home' => 'หน้าแรก',
            'index' => 'หน้าแรก',
            'thanks' => 'ขอบคุณ',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'forum covers',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'orders',
            'orders-show' => 'order',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => '',
            'logs-index' => 'log',
            'root' => 'index',

            'beatmapsets' => [
                '_' => 'beatmapsets',
                'show' => 'detail',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'ทั่วไป',
            'home' => 'หน้าแรก',
            'changelog-index' => 'บันทึกการเปลี่ยนแปลง',
            'beatmaps' => 'รายการ Beatmap',
            'download' => 'ดาวน์โหลด osu!',
            'wiki' => 'วิกิ',
        ],
        'help' => [
            '_' => 'ความช่วยเหลือและชุมชน',
            'faq' => 'คำถามที่พบบ่อย',
            'forum' => 'ฟอรัมชุมชน',
            'livestreams' => 'การถ่ายทอดสด',
            'report' => 'รายงานปัญหา',
        ],
        'legal' => [
            '_' => 'สถานะและกฎหมาย',
            'copyright' => 'ลิขสิทธิ์ (DMCA)',
            'privacy' => 'ความเป็นส่วนตัว',
            'server_status' => 'สถานะของเซิร์ฟเวอร์',
            'source_code' => '',
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
            'email' => 'ที่อยู่อีเมล',
            'forgot' => "ฉันลืมรายละเอียดของฉัน",
            'password' => 'รหัสผ่าน',
            'title' => 'ลงชื่อเข้าใช้เพื่อดำเนินต่อ',

            'error' => [
                'email' => "ชื่อผู้ใช้หรืออีเมลแอดเดรสไม่มีอยู่จริง",
                'password' => 'รหัสผ่านไม่ถูกต้อง',
            ],
        ],

        'register' => [
            'info' => "คุณต้องมีบัญชีครับ ทำไมคุณยังไม่มีล่ะ?",
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
