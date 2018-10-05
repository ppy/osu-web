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
    'admin' => [
        'warehouse' => 'คลังสินค้า',
    ],

    'cart' => [
        'checkout' => 'ชำระเงิน',
        'more_goodies' => 'ฉันอยากจะดูของอยากอื่นก่อนที่จะดําเนินการสั่งซื้อ',
        'shipping_fees' => 'ค่าส่ง',
        'title' => 'ตะกร้าสินค้า',
        'total' => 'ทั้งหมด',

        'errors_no_checkout' => [
            'line_1' => 'อ้าว! ตะกร้าสินค้าของคุณมีปัญหาที่ทําให้คุณจ่ายเงินไม่ได้!',
            'line_2' => 'กรุณานําไอเทมข้างบนออกหรืออัพเดทเพิ่อที่จะดําเนินการต่อไป',
        ],

        'empty' => [
            'text' => 'ไม่มีสินค้าอยู่ในตะกร้าสินค้าของคุณ',
            'return_link' => [
                '_' => 'กลับไปที่ :link เพื่อดูสินค้าอื่นๆ!',
                'link_text' => 'รายการร้านค้า',
            ],
        ],
    ],

    'checkout' => [
        'cart_problems' => 'ตายแล้ว มีปัญหาบางอย่างกับตะกร้าสินค้าของคุณ!',
        'cart_problems_edit' => 'กดที่นี่เพื่อแก้ไข',
        'declined' => 'การชำระเงินถูกยกเลิก',
        'old_cart' => 'เหมือนว่าตะกร้าสินค้าของคุณจะเก่าและได้ทำการรีโหลดให้แล้ว กรุณาลองใหม่อีกครั้ง',
        'pay' => 'จ่ายด้วย PayPal',
        'pending_checkout' => [
            'line_1' => 'การชำระเงินก่อนหน้านี้ได้เริ่มแล้ว แต่ยังไม่สำเร็จ',
            'line_2' => 'โปรดเลือกวิธีชำระเงินเพื่อดำเนินการสั่งซื้อต่อหรือ :link เพื่อยกเลิก',
            'link_text' => 'คลิกที่นี่',
        ],
        'delayed_shipping' => 'ขณะนี้เราได้รับการสั่งสินค้าเป็นจำนวนมาก เราขอขอบคุณที่คุณซื้อสินค้ากับเรา แต่สินค้าอาจจะถึงมือคุณ**ช้าลง 1-2 สัปดาห์** เพื่อเราจะสามารถจัดการกับรายการสั่งสินค้าที่มีอยู่ก่อนได้',
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

        'not_modifiable_exception' => [
            'cancelled' => 'คุณไม่สามารถแก้ไขหรือยกเลิกการสั่งซื้อได้',
            'checkout' => 'คุณไม่สามารถแก้ไขออเดอร์ของคุณได้ในระหว่างที่กำลังประมวลผลอยู่', // checkout and processing should have the same message.
            'default' => 'สั่งซื้อไม่สามารถปรับเปลี่ยน',
            'delivered' => 'คุณไม่สามารถแก้ไขออเดอร์ของคุณได้เพราะมันถูกจัดส่งเรียบร้อยแล้ว',
            'paid' => '',
            'processing' => '',
            'shipped' => '',
        ],
    ],

    'product' => [
        'name' => 'ชื่อ',

        'stock' => [
            'out' => 'สินค้านี้ได้หมดไปแล้ว กลับมาดูอีกรอบในภายหลัง!',
            'out_with_alternative' => 'น่าเสียดายสินค้านี้หมดแล้ว กรุณากดที่ลูกศรเพื่อเปลี่ยนรูปแบบสินค้า หรือกลับมาดูอีกรอบในภายหลัง!',
        ],

        'add_to_cart' => 'เพิ่มไปยังตะกร้า',
        'notify' => 'แจ้งเตือนฉันด้วยเมื่อมีสินค้า!',

        'notification_success' => 'เราจะแจ้งเตือนคุณทันทีเมื่อสินค้าเข้าแล้ว คลิก :link เพื่อยกเลิก',
        'notification_remove_text' => 'ที่นี่',

        'notification_in_stock' => 'สินค้านี้มีในคลังเราอยู่แล้ว!',
    ],

    'supporter_tag' => [
        'gift' => 'ส่งให้ผู้เล่นอื่น',
        'require_login' => [
            '_' => '',
            'link_text' => 'เข้าสู่ระบบ',
        ],
    ],

    'username_change' => [
        'check' => 'ใส่ชื่อผู้ใช้เพื่อตรวจสอบความพร้อมการใช้งาน!',
        'checking' => 'กำลังตรวจความพร้อมใช้งานของ :username...',
        'require_login' => [
            '_' => 'คุณจะต้อง:linkจึงจะเปลี่ยนชื่อได้!',
            'link_text' => 'เข้าสู่ระบบ',
        ],
    ],
];
