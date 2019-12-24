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
    'index' => [
        'none_running' => 'ไม่มีทัวร์นาเมนต์ในขณะนี้ มาทีหลังนะ',
        'registration_period' => 'Registration: :start to :end',

        'header' => [
            'title' => 'คอมมูนิตี้ ทัวร์นาเมนต์',
        ],

        'item' => [
            'registered' => 'ผู้เล่นที่ลงทะเบียน',
        ],

        'state' => [
            'current' => 'ทัวร์นาเมนต์ที่กำลังดำเนินอยู่',
            'previous' => 'ทัวร์นาเมนต์ที่เสร็จสิ้นลงแล้ว',
        ],
    ],

    'show' => [
        'banner' => 'สนับสนุนทีมของคุณ',
        'entered' => 'คุณลงทะเบียนการแข่งขันนี้แล้ว.<br><br>โปรดทราบว่าข้อความนี้<b>ไม่ได้</b>แปลว่าคุณจะได้อยู่ในทีม<br><br>และจะมีอีเมล์ที่มีคำแนะนำเพิ่มเติมส่งไปใกล้วันแข่ง และกรุณาตรวจสอบว่าอีเมล์ของบัญชี osu! นั้นถูกต้อง',
        'info_page' => 'หน้าข้อมูล',
        'login_to_register' => 'กรุณา :login เพื่อดูข้อมูลการลงทะเบียน',
        'not_yet_entered' => 'คุณไม่สามารถลงทะเบียนการแข่งขันนี้ได้',
        'rank_too_low' => 'ขออภัย อันดับของคุณยังไม่ถึงเกณฑ์สำหรับการแข่งขันนี้',
        'registration_ends' => 'ปิดลงทะเบียน :date',

        'button' => [
            'cancel' => 'ยกเลิกการลงทะเบียน',
            'register' => 'ลงทะเบียน',
        ],

        'period' => [
            'end' => '',
            'start' => '',
        ],

        'state' => [
            'before_registration' => 'การลงทะเบียนสำหรับการแข่งขันนี้ยังไม่เปิด',
            'ended' => 'การแข่งขันนี้ได้เสร็จสิ้นแล้ว ตรวจสอบผลลัพธ์จากหน้าข้อมูล',
            'registration_closed' => 'การลงทะเบียนสำหรับการแข่งขันนี้ปิดแล้ว ตรวจสอบหน้าข้อมูลล่าสุด',
            'running' => 'ทัวร์นาเมนต์นี้อยู่ระหว่างการดำเนินการ ตรวจสอบหน้าข้อมูลสำหรับรายละเอียดเพิ่มเติม',
        ],
    ],
    'tournament_period' => ':start ถึง :end',
];
