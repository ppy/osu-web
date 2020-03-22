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
    'limitation_notice' => 'หมายเหตุ: เฉพาะคนใช้ <a href=":lazer_link">osu! lazer</a> หรือเว็บไซต์ใหม่เท่านั้นที่จะได้รับข้อความผ่านระบบนี้<br/>ถ้าคุณไม่แน่ใจ ส่งข้อความผ่านทาง<a href=":oldpm_link">ฟอรั่มเก่า</a>แทน',
    'talking_in' => 'กำลังสนทนาใน :channel',
    'talking_with' => 'กำลังสนทนากับ :name',
    'title_compact' => 'ห้องสนทนา',

    'cannot_send' => [
        'channel' => 'คุณไม่สามารถส่งข้อความผ่านช่องทางนี้ได้ในเวลานี้ อาจเนื่องมาจากสาเหตุต่อไปนี้',
        'user' => 'คุณไม่สามารถส่งข้อความหาคนนี้ได้ในเวลานี้ อาจเนื่องมาจากสาเหตุต่อไปนี้',
        'reasons' => [
            'blocked' => 'คุณถูกบล็อกโดยผู้รับ',
            'channel_moderated' => 'แชนแนลนี้ถูกจำกัดแล้ว',
            'friends_only' => 'ผู้ใช้คนนี้จะรับข้อความจากเพื่อนของเขาเท่านั้น',
            'restricted' => 'คุณถูกจำกัดการใช้งานอยู่ในตอนนี้',
            'target_restricted' => 'ผู้ใช้งานคนนี้ถูกจำกัดการใช้งาน',
        ],
    ],
    'input' => [
        'disabled' => 'ไม่สามารถส่งข้อความได้...',
        'placeholder' => 'พิมพ์ข้อความ...',
        'send' => 'ส่ง',
    ],
    'no-conversations' => [
        'howto' => "เริ่มต้นการสนทนาจากโปรไฟล์ผู้ใช้หรือการ์ดป๊อปอัพ",
        'lazer' => 'แชแนลสาธารณะที่คุณเข้าผ่าน <a href=":link">osu!lazer</a> จะมาแสดงที่นี่',
        'pm_limitations' => 'เฉพาะคนที่ใช้ <a href=":link">osu!lazer</a> หรือเว็บไซต์เท่านั้น จะได้รับ PMs',
        'title' => 'ยังไม่มีการสนทนา',
    ],
];
