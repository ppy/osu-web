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
    'header' => [
        'small' => 'แข่งขันกันได้มากกว่าแค่คลิ๊กเจ้าวงกลม',
        'large' => 'คอมมูนิตี้ ทัวร์นาเมนต์',
    ],

    'index' => [
        'nav_title' => '',
    ],

    'voting' => [
        'over' => 'การโหวตนั้นได้สิ้นสุดลงแล้ว',
        'login_required' => 'กรุณาเข้าสู่ระบบเพื่อทำการโหวต',

        'best_of' => [
            'none_played' => "ดูเหมือนคุณจะไม่ได้เล่น beatmap ที่เข้าประกวดอยู่นะ",
        ],

        'button' => [
            'add' => 'โหวต',
            'remove' => 'ลบโหวต',
            'used_up' => 'คุณได้ใช้คะแนนโหวตหมดแล้ว',
        ],
    ],
    'entry' => [
        '_' => 'รายการ',
        'login_required' => 'กรุณาเข้าสู่ระบบเพื่อร่วมเข้าประกวด',
        'silenced_or_restricted' => 'คุณไม่สามารถเข้าประกวดได้ในระหว่างที่บัญชีของคุณโดนระงับสิทธิ์หรือเงียบอยู่',
        'preparation' => 'ทางเรากำลังเตรียมการประกวดอยู่ กรุณารออีกสักพัก',
        'over' => 'ขอบคุณที่เข้าร่วมการประกวดในครั้งนี้ เราได้ปิดรับผลงานสำหรับการประกวดครั้งนี้แล้วและการโหวตจะเริ่มขึ้นเร็วๆนี้',
        'limit_reached' => 'คุณถึงขีดจำกัดของปริมาณงานที่ส่งเข้าประกวดได้แล้ว',
        'drop_here' => 'ส่งงานของคุณตรงนี้',
        'download' => 'ดาวน์โหลด .osz',
        'wrong_type' => [
            'art' => 'เฉพาะไฟล์นามสกุล .jpg และ .png เท่านั้นที่สามารถส่งเข้าประกวดได้',
            'beatmap' => 'เฉพาะไฟล์นามสกุล .osu เท่านั้นที่สามารถส่งเข้าประกวดได้',
            'music' => 'เฉพาะไฟล์นามสกุล .mp3 เท่านั้นที่สามารถส่งเข้าประกวดได้',
        ],
        'too_big' => 'งานประกวดครั้งนี้สามารถส่งได้มากสุด :limit งาน',
    ],
    'beatmaps' => [
        'download' => 'ดาวน์โหลดผลงาน',
    ],
    'vote' => [
        'list' => 'โหวต',
        'count' => ':count_delimited โหวต|:count_delimited โหวตทั้งหมด',
        'points' => ':count_delimited แต้ม|:count_delimited แต้มทั้งหมด',
    ],
    'dates' => [
        'ended' => 'สิ้นสุดเมื่อวันที่ :date',

        'starts' => [
            '_' => 'เริ่ม :date',
            'soon' => 'เร็ว ๆ นี้™',
        ],
    ],
    'states' => [
        'entry' => 'เปิดรับงาน',
        'voting' => 'เริ่มเปิดโหวต',
        'results' => 'ประกาศผล',
    ],
];
