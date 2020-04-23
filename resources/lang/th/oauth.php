<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'ยกเลิก',

    'authorise' => [
        'request' => 'ต้องการสิทธิ์ในการเข้าถึงบัญชีของคุณ',
        'scopes_title' => 'แอปพลิเคชันนี้จะสามารถ:',
        'title' => 'ต้องได้รับอนุญาตก่อน',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'คุณแน่ใจหรือไม่ว่าต้องการลบสิทธิ์การใช้งานนี้?',
        'scopes_title' => 'แอปพลิเคชันนี้สามารถ:',
        'owned_by' => ':user เป็นเจ้าของ',
        'none' => 'ไม่มี Clients',

        'revoked' => [
            'false' => 'ยกเลิกการเข้าถึง',
            'true' => 'ยกเลิกการเข้าถึงแล้ว',
        ],
    ],

    'client' => [
        'id' => 'ID ของไคลเอนต์',
        'name' => 'ชื่อแอปพลิเคชัน',
        'redirect' => '',
        'reset' => '',
        'reset_failed' => '',
        'secret' => 'รหัสลับไคลเอ็นต์',

        'secret_visible' => [
            'false' => '',
            'true' => '',
        ],
    ],

    'new_client' => [
        'header' => '',
        'register' => 'ลงทะเบียนแอปพลิเคชั่น',
        'terms_of_use' => [
            '_' => '',
            'link' => 'ข้อกำหนดการใช้งาน',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => 'คุณแน่ใจหรือว่าต้องการลบ Client นี้?',
        'confirm_reset' => '',
        'new' => '',
        'none' => '',

        'revoked' => [
            'false' => 'ลบ',
            'true' => 'ถูกลบแล้ว',
        ],
    ],
];
