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
    'box' => [
        'sent' => 'อีเมล์ได้ถูกส่งไปที่ :mail พร้อมรหัสยืนยันตัวตนแล้ว กรุณาป้อนรหัส',
        'title' => 'ยืนยันตัวตนบัญชี',
        'verifying' => 'กำลังยืนยันตัวตน...',
        'issuing' => 'กำลังส่งรหัสชุดใหม่...',

        'info' => [
            'check_spam' => "หากไม่พบอีเมล ให้ลองค้นหาที่โฟลเดอร์สแปมของท่านดู",
            'recover' => "หากคุณเข้าอีเมล์ไม่ได้ หรือลืมอีเมล์ที่ผูกกับบัญชีผู้ใช้ของคุณ กรุณาทำตามนี้ :link.",
            'recover_link' => 'ขั้นตอนการกู้อีเมลได้ที่นี่',
            'reissue' => 'คุณสามารถ :reissue_link หรือ :logout_link.',
            'reissue_link' => 'ขอรหัสใหม่',
            'logout_link' => 'ออกจากระบบ',
        ],
    ],

    'errors' => [
        'expired' => 'รหัสยืนยันตัวตนนี้หมดอายุแล้ว ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
        'incorrect_key' => 'รหัสยืนยันตัวตนไม่ถูกต้อง',
        'retries_exceeded' => 'รหัสยืนยันตัวตนไม่ถูกต้อง จำนวนการลองใหม่เกินกว่าที่กำหนด ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
        'reissued' => 'รหัสยืนยันตัวตนถูกเปลี่ยน ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
        'unknown' => 'พบข้อผิดพลาดเกิดขึ้น ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
    ],
];
