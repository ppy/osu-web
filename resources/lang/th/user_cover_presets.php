<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'batch_disable' => 'ปิดการใช้งานตามที่เลือก',
        'batch_enable' => 'เปิดการใช้งานตามที่เลือก',

        'batch_confirm' => [
            '_' => ':action :items?',
            'disable' => 'ปิดการใช้งาน',
            'enable' => 'เปิดการใช้งาน',
            'items' => ':count_delimited ปก|:count_delimited ปก',
        ],

        'create_form' => [
            'files' => 'ไฟล์',
            'submit' => 'บันทึก',
            'title' => 'เพิ่มใหม่',
        ],

        'item' => [
            'click_to_disable' => 'คลิกเพื่อปิดใช้งาน',
            'click_to_enable' => 'คลิกเพื่อเปิดใช้งาน',
            'enabled' => 'เปิดใช้งาน',
            'disabled' => 'ปิดใช้งาน',
            'image_store' => 'ตั้งรูปภาพ',
            'image_update' => 'เปลี่ยนแทนที่รูปภาพ',
        ],
    ],
    'store' => [
        'failed' => 'เกิดข้อผิดพลาดขณะสร้างปก: :error',
        'ok' => 'สร้างปกขึ้นแล้ว',
    ],
];
