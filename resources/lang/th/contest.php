<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'แข่งขันกันได้มากกว่าแค่คลิ๊กวงกลม',
        'large' => 'คอมมูนิตี้ ทัวร์นาเมนต์',
    ],

    'index' => [
        'nav_title' => 'รายการ',
    ],

    'voting' => [
        'login_required' => 'กรุณาเข้าสู่ระบบเพื่อทำการโหวต',
        'over' => 'การโหวตนั้นได้สิ้นสุดลงแล้ว',
        'show_voted_only' => 'แสดงโหวต',

        'best_of' => [
            'none_played' => "ดูเหมือนคุณจะไม่ได้เล่น beatmap ที่เข้าประกวดอยู่นะ",
        ],

        'button' => [
            'add' => 'โหวต',
            'remove' => 'ลบโหวต',
            'used_up' => 'คุณได้ใช้คะแนนโหวตหมดแล้ว',
        ],

        'progress' => [
            '_' => '',
        ],
    ],
    'entry' => [
        '_' => 'รายการ',
        'login_required' => 'กรุณาเข้าสู่ระบบเพื่อร่วมเข้าประกวด',
        'silenced_or_restricted' => 'คุณไม่สามารถเข้าประกวดได้ในระหว่างที่บัญชีของคุณโดนระงับสิทธิ์หรือเงียบอยู่',
        'preparation' => 'ทางเรากำลังเตรียมการประกวดอยู่ กรุณารออีกสักพัก',
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
        'ended_no_date' => 'จบแล้ว',

        'starts' => [
            '_' => 'เริ่มเมื่อวันที่ :date',
            'soon' => 'เร็ว ๆ นี้™',
        ],
    ],
    'states' => [
        'entry' => 'เปิดรับงาน',
        'voting' => 'เริ่มเปิดโหวต',
        'results' => 'ประกาศผล',
    ],
];
