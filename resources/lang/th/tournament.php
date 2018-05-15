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
    'index' => [
        'header' => [
            'subtitle' => 'A listing of active, officially-recognised tournaments',
            'title' => 'Community Tournaments',
        ],
        'none_running' => 'ไม่มีทัวร์นาเมนต์ในขณะนี้ โปรดตรวจสอบในภายหลัง',
        'registration_period' => 'Registration: :start to :end',
    ],

    'show' => [
        'banner' => 'สนับสนุนทีมของคุณ',
        'entered' => 'Your are registered for this tournament.<br><br>Note that this does not mean you have been assigned to a team.<br><br>Further instructions will be sent to you via email closer to the tournament date, so please ensure your osu! account\'s email address is valid!',
        'info_page' => 'หน้าข้อมูล',
        'login_to_register' => 'กรุณา :login เพื่อดูข้อมูลการลงทะเบียน',
        'not_yet_entered' => 'คุณไม่สามารถลงทะเบียนการแข่งขันนี้ได้',
        'rank_too_low' => 'ขออภัย อันดับของคุณยังไม่ถึงเกณฑ์สำหรับการแข่งขันนี้',
        'registration_ends' => 'ปิดลงทะเบียน :date',

        'button' => [
            'cancel' => 'ยกเลิกการลงทะเบียน',
            'register' => 'ลงทะเบียน',
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
