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
    'not_negative' => ':attribute เป็นค่าลบไม่ได้',
    'required' => 'ต้องมี :attribute',
    'too_long' => ':attribute เกินความยาวสูงสุด - สามารถใส่ได้ถึงแค่ :limit ตัวอักษร',
    'wrong_confirmation' => 'การยืนยันไม่ตรงกัน',

    'beatmap_discussion_post' => [
        'discussion_locked' => 'การสนทนาได้ถูกล็อกไว้',
        'first_post' => 'ไม่สามารถลบโพสต์ที่เริ่มต้น',

        'attributes' => [
            'message' => 'ข้อความ',
        ],
    ],

    'beatmapset_discussion' => [
        'beatmap_missing' => 'ช่วงเวลาได้ถูกกำหนดไว้แต่ไม่พบ Beatmap',
        'beatmapset_no_hype' => "Beatmap นี้ไม่สามารถ hype ได้",
        'hype_requires_null_beatmap' => 'การ Hype ต้องทำในส่วนของ General (all difficulties) เท่านั้น',
        'invalid_beatmap_id' => 'ระดับความยากไม่ได้เลือกอย่างถูกต้อง',
        'invalid_beatmapset_id' => 'Beatmap ไม่ได้เลือกอย่างถูกต้อง',
        'locked' => 'การสนทนาได้ถูกล็อกไว้',

        'attributes' => [
            'message_type' => 'ประเภทของข้อความ',
            'timestamp' => '',
        ],

        'hype' => [
            'guest' => 'ต้องเข้าสู่ระบบก่อนถึงจะ hype ได้',
            'hyped' => 'คุณได้ hype Beatmap นี้ไปแล้ว',
            'limit_exceeded' => 'คุณใช้จำนวน hype หมดแล้ว',
            'not_hypeable' => 'Beatmap นี้ไม่สามารถ hype ได้',
            'owner' => 'ห้าม hype Beatmap ของคุณเอง',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => 'ช่วงเวลาที่กำหนดไว้เกินเวลาของ Beatmap',
            'negative' => "ช่วงเวลาไม่สามารถติดลบได้",
        ],
    ],

    'comment' => [
        'deleted_parent' => 'ไม่อนุญาตให้ตอบกลับในคอมเม้นต์ที่ถูกลบไปแล้ว',

        'attributes' => [
            'message' => '',
        ],
    ],

    'follow' => [
        'invalid' => '',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => 'สามารถเฉพาะโหวตขอลักษณะพิเศษอันเดียวเท่านั้น',
            'not_enough_feature_votes' => 'โหวตไม่เพียงพอ',
        ],

        'poll_vote' => [
            'invalid' => 'ตัวเลือกที่ระบุไม่ถูกต้อง',
        ],

        'post' => [
            'beatmapset_post_no_delete' => 'ไม่อนุญาตให้ลบโพสต์ Metadata ของบีตแมป',
            'beatmapset_post_no_edit' => 'ไม่อนุญาตให้ดัดแปลงโพสต์ Metadata ของบีตแมป',
            'only_quote' => 'การตอบกลับของคุณมีแค่คำพูด',

            'attributes' => [
                'post_text' => '',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => 'ชื่อหัวข้อ',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => 'ห้ามมีตัวเลือกซ้ำกัน',
            'grace_period_expired' => 'ไม่สามารถแก้ไขโพลล์ได้หลังจากผ่านไปมากกว่า :limit ชั่วโมง',
            'hiding_results_forever' => 'ไม่สามารถซ่อนผลโหวตของโพลล์ที่ไม่จำกัดเวลาโหวตได้',
            'invalid_max_options' => 'คัวเลือกต่อคนต้องไม่เกินจำนวนตัวเลือกที่ใช้ได้',
            'minimum_one_selection' => 'ต้องมีตัวเลือกอย่างน้อย 1 ตัวต่อผู้เล่น 1 คน',
            'minimum_two_options' => 'ต้องการอย่างน้อยสองตัวเลือก',
            'too_many_options' => 'เกินจำนวนตัวเลือกที่อนุญาตสูงสุด',

            'attributes' => [
                'title' => 'ชื่อโพลล์',
            ],
        ],

        'topic_vote' => [
            'required' => 'เลือกตัวเลือกเมื่อจะโหวต',
            'too_many' => 'เลือกตัวเลือกมากเกินที่กำหนดไว้',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => '',
            'url' => 'กรุณาใส่ URL ที่ถูกต้อง',

            'attributes' => [
                'name' => 'ชื่อแอปพลิเคชัน',
                'redirect' => '',
            ],
        ],
    ],

    'user' => [
        'contains_username' => 'รหัสผ่านต้องไม่ประกอบด้วยชื่อผู้ใช้',
        'email_already_used' => 'อีเมลนี้ถูกใช้ไปแล้ว',
        'invalid_country' => 'ประเทศไม่ได้อยู่ในฐานข้อมูล',
        'invalid_discord' => 'ชื่อผู้ใช้ Discord ไม่ถูกต้อง',
        'invalid_email' => "เหมือนกับว่ามันไม่ใช่ที่อยู่อีเมล",
        'too_short' => 'รหัสผ่านใหม่สั้นเกินไป',
        'unknown_duplicate' => 'ชื่อผู้ใช้หรืออีเมลถูกใช้ไปแล้ว',
        'username_available_in' => 'ชื่อผู้ใช้นี้สามารถใช้งานได้ใน :duration',
        'username_available_soon' => 'ชื่อผู้ใช้นี้จะใช้ได้ในอีกไม่กี่นาที',
        'username_invalid_characters' => 'ชื่อผู้ใช้นี้ประกอบไปด้วยตัวอักขระที่ไม่ถูกต้อง',
        'username_in_use' => 'ชื่อผู้ใช้กำลังนี้ถูกใช้อยู่',
        'username_locked' => 'ชื่อนี้ถูกใช้ไปแล้ว', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => 'กรุณาใช้ขีดใต้หรือช่องว่างอย่างใดอย่างนึง ไม่ใช่ทั้งสองอัน!',
        'username_no_spaces' => "ชื่อผู้ใช้ไม่สามารถเริ่มต้นหรือจบด้วยช่องว่าง",
        'username_not_allowed' => 'ไม่อนุญาตให้ใช้ชื่อนี้',
        'username_too_short' => 'ชื่อผู้ใช้ที่ได้ขอร้องมาสั้นเกินไป',
        'username_too_long' => 'ชื่อผู้ใช้นี้ยาวเกินไป',
        'weak' => 'รหัสผ่านถูกขึ้น Blacklist ไว้',
        'wrong_current_password' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง',
        'wrong_email_confirmation' => 'การยืนยันอีเมลไม่ตรงกัน',
        'wrong_password_confirmation' => 'การยืนยันรหัสผ่านไม่ตรงกัน',
        'too_long' => 'เกินความยาวสูงสุด - สามารถกำหนดได้ถึง :limit characters',

        'attributes' => [
            'username' => 'ชื่อผู้ใช้',
            'user_email' => 'อีเมล์',
            'password' => 'รหัสผ่าน',
        ],

        'change_username' => [
            'restricted' => 'คุณไม่สามารถเปลี่ยนผู้ใช้ได้ขณะถูกจำกัดการใช้งาน',
            'supporter_required' => [
                '_' => 'คุณต้องมี:linkจึงจะเปลี่ยนชื่อได้!',
                'link_text' => 'สนับสนุน osu!',
            ],
            'username_is_same' => 'บ้าน่า นี่มันชื่อผู้ใช้คุณตอนนี้นี่',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => '',
        'self' => "เดี๋ยว คุณรายงานตัวเองไม่ได้",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => 'ปริมาณ',
                'cost' => 'ราคา',
            ],
        ],
    ],
];
