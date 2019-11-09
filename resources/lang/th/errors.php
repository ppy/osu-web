<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
