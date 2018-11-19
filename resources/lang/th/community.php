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
    'support' => [
        'header' => [
            // size in font-size
            'big_description' => '',
            'small_description' => '',
            'support_button' => 'ฉันต้องการสนับสนุน osu!',
        ],

        'dev_quote' => 'osu! เป็นเกมเล่นฟรีอย่างสมบูรณ์ แต่การให้บริการนั้นไม่ค่อยจะฟรีสักเท่าไหร่
        ทั้งค่าใช้จ่ายเกี่ยวกับเซิร์ฟเวอร์และแบนด์วิดธ์คุณภาพสูง เวลาในการดูแลระบบและชุมชน
        การให้รางวัลในการแข่งขัน ตอบคำถามช่วยเหลือ และทำให้ผู้คนมีความสุขโดยทั่วไป osu! ใช้เงินค่อนข้างเยอะมาก!
        โอ้ แล้วก็อย่าลืมว่าเราทำโดยที่ไม่รับโฆษณาใดๆและร่วมหุ้นกับผู้อื่นโดยมีแถบเครื่องมือที่ไร้สาระหรืออะไรพวกนั้น!
            <br/><br/>osu! ในที่สุดแล้วถูกควบคุมส่วนใหญ่โดยตัวผมเอง คุณอาจจะรู้จักผมดีที่สุดในนาม "peppy"
            ผมต้องลาออกจากงานของผมเพื่อมาดูแล osu!
            และบางที ผมก็มีปัญหาในการรักษาคุณภาพที่ผมตั้งเป้าไว้
            ผมอยากจะขอบคุณคนที่ได้สนับสนุน osu! มาจนถึงตอนนี้อย่างถึงที่สุด
            และขอบคุณทุกคนที่ยังสนับสนุนเกมที่น่าทึ่งและชุมชนนี้ในอนาคต :)',

        'supporter_status' => [
            'contribution' => 'ขอบคุณสำหรับการสนับสนุนของคุณ! คุณได้สนับสนุนเป็นเงินรวม :dollars จากการซิ้อแท้ก :tags อัน!',
            'gifted' => ':gifted แท้กจากการซื้อของคุณเป็นการให้คนอื่น (เป็นเงินรวม :giftedDollars) ใจกว้างมาก!',
            'not_yet' => "คุณยังไม่มีแท้กสนับสนุน :(",
            'title' => 'สถานะการสนับสนุนตอนนี้',
            'valid_until' => 'แท้กสนับสนุนคุณใช้ได้จนถึง :date!',
            'was_valid_until' => 'แท้กสนับสนุนคุณใช้ได้จนถึง :date.',
        ],

        'why_support' => [
            'title' => 'ทำไมฉันจึงควรสนับสนุน osu!',
            'blocks' => [
                'dev' => 'ถูกสร้างและดูแลส่วนใหญ่โดยชายคนหนึ่งในออสเตรเลีย',
                'time' => 'ใช้เวลามากมายในการดูแลจนไม่สามารถเรียกว่างานอดิเรกได้อีกแล้ว',
                'ads' => 'ไม่มีโฆษณาใดๆ <br/><br/>
                        ไม่เหมือน 99.95% ของเว็บ เราไม่ทำกำไรจากการโยนสิ่งต่างๆใส่หน้าคุณ',
                'goodies' => 'คุณได้รับส่วนเสริมหลายอย่าง!',
            ],
        ],

        'perks' => [
            'title' => 'โอ? ฉันได้อะไรบ้างเหรอ?!',
            'osu_direct' => [
                'title' => 'osu!direct',
                'description' => 'การหา beatmaps อย่างเร็วเร็วและง่ายดายโดยที่ไม่ต้องออกจากเกม',
            ],

            'auto_downloads' => [
                'title' => 'การดาวน์โหลดอัตโนมัติ',
                'description' => 'ดาวน์โหลดอัตโนมัติเมื่อเล่นกับผู้เล่นหลายคน ดูคนอื่นเล่น หรือคลิกลิงค์ในแชท!',
            ],

            'upload_more' => [
                'title' => 'อัปโหลดเพิ่ม',
                'description' => 'ช่องอัพโหลด beatmap เพิ่มเติม (ต่อแมพจัดอันดับที่มีอยู่) มากถึง 10 แมพ',
            ],

            'early_access' => [
                'title' => 'เข้าเล่นช่วงพัฒนา',
                'description' => 'สามารถเข้าเล่นช่วงพัฒนาได้ โดยคุณสามารถทดลองระบบใหม่ๆได้ก่อนที่มันจะมาจริงๆ!',
            ],

            'customisation' => [
                'title' => 'การปรับแต่ง',
                'description' => 'ปรับแต่งโปรไฟล์ของคุณโดยการเพิ่มหน้า Userpage ที่ปรับแต่งได้อย่างสมบูรณ์',
            ],

            'beatmap_filters' => [
                'title' => 'ตัวกรอง Beatmap',
                'description' => 'กรอง beatmap จากเล่นแล้ว ยังไม่เคยเล่น และแร้งค์ที่เคยได้รับ (ถ้ามี)',
            ],

            'yellow_fellow' => [
                'title' => 'เพื่อนสีเหลือง',
                'description' => 'ได้รับการยอมรับในเกมกับสีชื่อผู้ใช้สีเหลืองสดใหม่',
            ],

            'speedy_downloads' => [
                'title' => 'ดาวน์โหลดอย่างรวดเร็ว',
                'description' => 'การจำกัดดาวน์โหลดผ่อนปรนมากขึ้น โดยเฉพาะอย่างยิ่งเมื่อใช้ osu!direct',
            ],

            'change_username' => [
                'title' => 'เปลี่ยนชื่อผู้ใช้',
                'description' => 'ความสามารถในการเปลี่ยนชื่อผู้ใช้ของคุณ โดยไม่มีค่าธรรมเนียมเพิ่มเติม (สูงสุดครั้งเดียว)',
            ],

            'skinnables' => [
                'title' => 'การสกินเพิ่มเติม',
                'description' => 'ส่วนที่สกินได้เพิ่มเติม เช่นพื้นหลังของเมนูหลัก',
            ],

            'feature_votes' => [
                'title' => 'โหวตระบบ',
                'description' => 'โหวตให้ระบบใหม่ๆ (สูงสุด 2 ครั้งต่อเดือน)',
            ],

            'sort_options' => [
                'title' => 'ตัวเลือกการเรียงลำดับ',
                'description' => 'ความสามารถในการดูกระดานคะแนนของประเทศ / เพื่อน / และตามมอดต่างๆในเกม',
            ],

            'feel_special' => [
                'title' => 'รู้สึกพิเศษ',
                'description' => 'ความรู้สึกอบอุ่นจากการทำส่วนของคุณเพื่อทำให้ osu! ทำงานได้อย่างราบรื่น!',
            ],

            'more_to_come' => [
                'title' => 'และอื่นๆอีกมากมาย',
                'description' => '',
            ],
        ],

        'convinced' => [
            'title' => 'ฉันเชื่อแล้ว! :D',
            'support' => 'สนับสนุน osu!',
            'gift' => 'หรือให้แท้กสนับสนุนแก่ผู้เล่นอื่น ๆ',
            'instructions' => 'คลิกที่ปุ่มหัวใจเพื่อดำเนินต่อไปที่ร้านของ osu!',
        ],
    ],
];
