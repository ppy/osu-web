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
    'cancel' => 'ยกเลิก',

    'authorise' => [
        'authorise' => 'อนุญาต',
        'request' => 'ต้องการสิทธิ์ในการเข้าถึงบัญชีของคุณ',
        'scopes_title' => 'แอปพลิเคชันนี้จะสามารถ:',
        'title' => 'ต้องได้รับอนุญาตก่อน',

        'wrong_user' => [
            '_' => 'คุณเข้าได้สู่ระบบผู้ใช้ :user :logout_link',
            'logout_link' => 'คลิกที่นี่เพื่อเข้าสู่ระบบด้วยผู้ใช้อื่น',
        ],
    ],

    'authorized_clients' => [
        'confirm_revoke' => '',
        'scopes_title' => 'แอปพลิเคชันนี้สามารถ:',
        'owned_by' => ':user เป็นเจ้าของ',
        'none' => '',

        'revoked' => [
            'false' => 'ยกเลิกการเข้าถึง',
            'true' => 'ยกเลิกการเข้าถึงแล้ว',
        ],
    ],

    'client' => [
        'id' => 'ID ของไคลเอนต์',
        'name' => 'ชื่อแอปพลิเคชัน',
        'redirect' => '',
        'secret' => '',
    ],

    'login' => [
        'download' => 'คลิกที่นี่เพื่อดาวน์โหลดเกมและสร้างบัญชีผู้ใช้',
        'label' => 'อย่างแรก ล็อกอินก่อนนะ',
        'title' => 'ลงชื่อเข้าใช้บัญชี',
    ],

    'new_client' => [
        'header' => '',
        'register' => '',
        'terms_of_use' => [
            '_' => '',
            'link' => 'ข้อกำหนดการใช้งาน',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '',
        'new' => '',
        'none' => '',

        'revoked' => [
            'false' => 'ลบ',
            'true' => 'ถูกลบแล้ว',
        ],
    ],
];
