<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

    'email' => [
        'subject' => 'ยืนยันตัวตนบัญชี osu!',
    ],

    'errors' => [
        'expired' => 'รหัสยืนยันตัวตนนี้หมดอายุแล้ว ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
        'incorrect_key' => 'รหัสยืนยันตัวตนไม่ถูกต้อง',
        'retries_exceeded' => 'รหัสยืนยันตัวตนไม่ถูกต้อง จำนวนการลองใหม่เกินกว่าที่กำหนด ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
        'reissued' => 'รหัสยืนยันตัวตนถูกเปลี่ยน ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
        'unknown' => 'พบข้อผิดพลาดเกิดขึ้น ได้ทำการส่งรหัสยืนยันตัวตนใหม่ไปทางอีเมลแล้ว',
    ],
];
