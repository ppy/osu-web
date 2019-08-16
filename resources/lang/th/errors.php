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
    'codes' => [
        'http-401' => 'กรุณาเข้าสู่ระบบเพื่อดำเนินการต่อไป',
        'http-403' => 'ไม่มีสิทธิ์การเข้าถึง',
        'http-404' => 'ไม่่พบข้อมูลที่ต้องการ',
        'http-429' => 'คุณพยายามเข้าถี่เกินไป กรุณารออีกสักพักแล้วเข้าใหม่',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'ระบบมีข้อผิดพลาด กรุณารีเฟรชหน้านี้ใหม่',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => 'โหมดที่ระบุไม่ถูกต้อง',
        'standard_converts_only' => 'ไม่พบคะแนนสำหรับโหมดและระดับความยากที่เลือกไว้',
    ],
    'checkout' => [
        'generic' => 'เกิดข้อผิดพลาดระหว่างการชำระเงินของคุณ',
    ],
    'search' => [
        'default' => '',
        'operation_timeout_exception' => '',
    ],

    'logged_out' => 'คุณได้ออกจากระบบแล้ว ลองเข้าใหม่แล้วลองอีกครั้ง',
    'supporter_only' => 'คุณต้องเป็นผู้สนับสนุนถึงจะเข้าใช้งานได้',
    'no_restricted_access' => 'คุณไม่สามารถทำสิ่งนี้ได้ระหว่างที่บัญชีคุณกำลังอยู่ในสถานะจำกัดสิทธิ์',
    'unknown' => 'พบเจอปัญหาไม่สามารถระบุได้',
];
