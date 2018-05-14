<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'admin' => [
        'warehouse' => 'คลังสินค้า',
    ],

    'checkout' => [
        'cart_problems' => 'ตายแล้ว มีปัญหาบางอย่างกับตะกร้าสินค้าของคุณ!',
        'pay' => 'จ่ายด้วย PayPal',
        'cart_problems_edit' => 'กดที่นี่เพื่อแก้ไข',
        'declined' => 'การชำระเงินถูกยกเลิก',
        'error' => 'มีปัญหาระหว่างเช็คเอาท์ :(',
        'old_cart' => 'เหมือนว่าตะกร้าสินค้าของคุณจะเก่ากว่าหน่อย และทำการอัพเดตให้แล้ว กรุณาลองใหม่อีกครั้ง',
        'pending_checkout' => [
            'line_1' => 'การชำระเงินก่อนหน้านี้ได้เริ่มแล้ว แต่ยังไม่เสร็จ',
            'line_2' => 'โปรดเลือกวิธีชำระเงินเพื่อดำเนินการสั่งซื้อต่อหรือ :link เพื่อยกเลิก',
            'link_text' => 'คลิกที่นี่',
        ],
        'delayed_shipping' => 'ขณะนี้เราได้รับการสั่งสินค้าเป็นจำนวนมาก เราขอขอบคุณที่ซื้อสินค้ากับเราแต่สินค้าอาจจะถึงมือคุณช้าลง **1-2 สัปดาห์** เพื่อเราจะสามารถจัดการกับรายการสั่งสินค้าที่มีอยู่ก่อนได้',
    ],

    'discount' => 'ถูกลง :percent%',

    'mail' => [
        'payment_completed' => [
            'subject' => 'เราได้รับคำสั่งซื้อ osu!store ของคุณแล้ว!',
        ],
    ],

    'order' => [
        'item' => [
            'display_name' => [
                'supporter_tag' => ':name สำหรับ :username (:duration)',
            ],
            'quantity' => 'จำนวน',
        ],
    ],

    'product' => [
        'name' => 'ชื่อ',

        'stock' => [
            'out' => 'สินค้าหมด! ไว้กลับมาดูอีกรอบภายหลัง',
            'out_with_alternative' => 'สินค้าชนิดนี้หมด กรุณากดที่ลูกศรเพื่อเปลี่ยนรูปแบบสินค้า หรือไว้กลับมาดูอีกรอบภายหลัง!',
        ],

        'add_to_cart' => 'เพิ่มไปยังตะกร้า',
        'notify' => 'แจ้งเตือนด้วยเมื่อมีสินค้า!',

        'notification_success' => 'เราจะแจ้งเตือนคุณทันทีเมื่อสินค้าเข้าแล้ว คลิก :link เพื่อยกเลิก',
        'notification_remove_text' => 'ที่นี่',

        'notification_in_stock' => 'สินค้านี้มีอยู่ในคลังเรา!',
    ],

    'supporter_tag' => [
        'gift' => 'ส่งให้ผู้เล่นอื่น',
        'require_login' => [
            '_' => 'คุณจะต้อง :link จึงจะเอา supporter tag ได้!',
            'link_text' => 'เข้าสู่ระบบ',
        ],
    ],

    'username_change' => [
        'check' => 'ใส่ username เพื่อตรวจสอบความพร้อมการใช้งาน!',
        'checking' => 'กำลังตรจความพร้อมสำหรับ :username...',
        'require_login' => [
            '_' => 'คุณจะต้อง :link จึงจะเปลี่ยนชื่อได้!',
            'link_text' => 'เข้าสู่ระบบ',
        ],
    ],
];
