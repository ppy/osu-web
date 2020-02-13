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
    'admin' => [
        'warehouse' => 'คลังสินค้า',
    ],

    'cart' => [
        'checkout' => 'ชำระเงิน',
        'info' => '',
        'more_goodies' => 'ฉันอยากจะดูของอยากอื่นก่อนที่จะดําเนินการสั่งซื้อ',
        'shipping_fees' => 'ค่าส่ง',
        'title' => 'ตะกร้าสินค้า',
        'total' => 'ทั้งหมด',

        'errors_no_checkout' => [
            'line_1' => 'อ้าว! ตะกร้าสินค้าของคุณมีปัญหาที่ทําให้คุณจ่ายเงินไม่ได้!',
            'line_2' => 'กรุณานําไอเทมข้างบนออกหรืออัพเดทเพิ่อที่จะดําเนินการต่อไป',
        ],

        'empty' => [
            'text' => 'ตะกร้าสินค้าว่าง',
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
        'delayed_shipping' => 'ขณะนี้เราได้รับการสั่งสินค้าเป็นจำนวนมาก เราขอขอบคุณที่คุณซื้อสินค้ากับเรา แต่สินค้าอาจจะถึงมือคุณ**ช้าลง 1-2 สัปดาห์** เพื่อเราจะสามารถจัดการกับรายการสั่งสินค้าที่มีอยู่ก่อนได้',
        'old_cart' => 'เหมือนว่าตะกร้าสินค้าของคุณจะเก่าและได้ทำการรีโหลดให้แล้ว กรุณาลองใหม่อีกครั้ง',
        'pay' => 'ชำระด้วย PayPal',

        'has_pending' => [
            '_' => 'คุณยังมีการชำระเงินที่ค้างอยู่ คลิกที่นี่ :link เพื่อตรวจสอบ',
            'link_text' => 'ที่นี่',
        ],

        'pending_checkout' => [
            'line_1' => 'การชำระเงินก่อนหน้านี้ได้เริ่มแล้ว แต่ยังไม่สำเร็จ',
            'line_2' => 'โปรดเลือกวิธีชำระเงินเพื่อดำเนินการสั่งซื้อต่อ',
        ],
    ],

    'discount' => 'ถูกลง :percent%',

    'invoice' => [
        'echeck_delay' => 'เนื่องจากการชำระเงินของคุณเป็น eCheck โปรดรอเพิ่มอีก 10 วันเพื่อให้การชำระเงินผ่าน PayPal!',
        'status' => [
            'processing' => [
                'title' => 'การชำระเงินของคุณยังไม่ได้รับการยืนยัน!',
                'line_1' => 'หากคุณชำระเงินไปแล้ว เราอาจยังรอการยืนยันของคุณ โปรดรีเฟรชหน้านี้ใน 1-2 นาที!',
                'line_2' => [
                    '_' => 'หากคุณประสบปัญหาระหว่างการชำระเงิน :link',
                    'link_text' => 'คลิกที่นี่แล้วดำเนินการชำระเงินต่อ',
                ],
            ],
        ],
    ],

    'order' => [
        'paid_on' => 'สั่งซื้อเมื่อ :date',

        'invoice' => 'ดูใบเสร็จ',
        'no_orders' => 'ไม่มีรายการให้ดู',
        'resume' => 'ดำเนินการชำระเงินต่อ',

        'item' => [
            'display_name' => [
                'supporter_tag' => ':name สำหรับ :username (:duration)',
            ],
            'quantity' => 'จำนวน',
        ],

        'not_modifiable_exception' => [
            'cancelled' => 'คุณไม่สามารถแก้ไขคำสั่งซื้อของคุณเนื่องจากมันถูกยกเลิกไปแล้ว',
            'checkout' => 'คุณไม่สามารถแก้ไขออเดอร์ของคุณได้ในระหว่างที่กำลังประมวลผลอยู่', // checkout and processing should have the same message.
            'default' => 'คำสั่งซื้อนี้ไม่สามารถแก้ไขได้',
            'delivered' => 'คุณไม่สามารถแก้ไขออเดอร์ของคุณได้เพราะมันถูกจัดส่งเรียบร้อยแล้ว',
            'paid' => 'คุณไม่สามารถแก้ไขออเดอร์ของคุณได้เพราะคุณได้จ่ายเงินไปแล้ว',
            'processing' => 'คุณไม่สามารถแก้ไขออเดอร์ของคุณได้ในระหว่างที่กำลังประมวลผลอยู่',
            'shipped' => 'คุณไม่สามารถแก้ไขออเดอร์ของคุณได้เพราะมันถูกจัดส่งเรียบร้อยแล้ว',
        ],

        'status' => [
            'cancelled' => 'ยกเลิก',
            'checkout' => 'กำลังเตรียมการ',
            'delivered' => 'จัดส่งแล้ว',
            'paid' => 'ชำระเงินแล้ว',
            'processing' => 'กำลังรอการยืนยัน',
            'shipped' => 'จัดส่งแล้ว',
        ],
    ],

    'product' => [
        'name' => 'ชื่อ',

        'stock' => [
            'out' => 'สินค้านี้หมดแล้ว มาตอนหลังนะ',
            'out_with_alternative' => 'สินค้านี้หมดแล้ว ลองกดปุ่ม Dropdown เพื่อดูรูปแบบสินค้าอื่น หรือมาดูอีกทีตอนหลังก็ได้',
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
            '_' => 'คุณจะเป็นต้อง :link จึงจะได้รับป้าย osu!supporter',
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

    'xsolla' => [
        'distributor' => '',
    ],
];
