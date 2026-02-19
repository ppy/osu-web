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

    'judge' => [
        'comments' => 'ความคิดเห็น',
        'hide_judged' => 'ซ่อนรายการที่ได้รับการตัดสินไปแล้ว',
        'nav_title' => 'ตัดสิน',
        'no_current_vote' => 'คุณยังไม่ได้โหวต',
        'update' => 'อัปเดต',
        'validation' => [
            'missing_score' => 'คะแนนที่ขาดหายไป',
            'contest_vote_judged' => 'ไม่สามารถโหวตในการแข่งขันที่มีการตัดสิน',
        ],
        'voted' => 'คุณได้ส่งโหวตสำหรับรายการนี้ไปแล้ว',
    ],

    'judge_results' => [
        '_' => 'ผลการตัดสิน',
        'creator' => 'ผู้สร้าง',
        'score' => 'คะแนน',
        'score_std' => '',
        'total_score' => 'คะแนนรวมทั้งหมด',
        'total_score_std' => '',
    ],

    'voting' => [
        'judge_link' => 'คุณเป็นผู้ตัดสินของการแข่งขันนี้ ตัดสินรายการที่นี่!',
        'judged_notice' => 'การแข่งขันนี้ใช้ระบบการตัดสินอยู่ ขณะนี้ผู้ตัดสินกำลังดำเนินการกับรายการต่างๆ',
        'login_required' => 'กรุณาเข้าสู่ระบบเพื่อทำการโหวต',
        'over' => 'การโหวตนั้นได้สิ้นสุดลงแล้ว',
        'show_voted_only' => 'แสดงโหวต',

        'best_of' => [
            'none_played' => "ดูเหมือนคุณจะไม่ได้เล่นบีทแมพที่เข้าประกวดอยู่นะ",
        ],

        'button' => [
            'add' => 'โหวต',
            'remove' => 'ลบโหวต',
            'used_up' => 'คุณได้ใช้คะแนนโหวตหมดแล้ว',
        ],

        'progress' => [
            '_' => 'โหวตแล้ว :used / :max',
        ],

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'ต้องเล่นบีทแมพทั้งหมดในเพลย์ลิสต์ที่กำหนดก่อนลงคะแนน',
            ],
        ],
    ],

    'entry' => [
        '_' => 'รายการ',
        'login_required' => 'กรุณาเข้าสู่ระบบเพื่อร่วมเข้าประกวด',
        'silenced_or_restricted' => 'คุณไม่สามารถเข้าประกวดได้ในระหว่างที่บัญชีของคุณโดนระงับสิทธิ์หรือเงียบอยู่',
        'preparation' => 'ทางเรากำลังเตรียมการประกวดอยู่ กรุณารออีกสักพัก',
        'drop_here' => 'ส่งงานของคุณตรงนี้',
        'allowed_extensions' => '',
        'max_size' => '',
        'required_dimensions' => '',
        'download' => 'ดาวน์โหลด .osz',
        'wrong_file_type' => '',
        'wrong_dimensions' => 'รายการสำหรับการแข่งขันนี้ต้องมีขนาด :widthx:height',
        'too_big' => 'งานประกวดครั้งนี้สามารถส่งได้มากสุด :limit งาน',
    ],

    'beatmaps' => [
        'download' => 'ดาวน์โหลดผลงาน',
    ],

    'vote' => [
        'list' => 'โหวต',
        'count' => ':count_delimited โหวต|:count_delimited โหวตทั้งหมด',
        'points' => ':count_delimited แต้ม|:count_delimited แต้มทั้งหมด',
        'points_float' => '',
    ],

    'dates' => [
        'ended' => 'สิ้นสุดเมื่อวันที่ :date',
        'ended_no_date' => 'จบแล้ว',

        'starts' => [
            '_' => 'เริ่มเมื่อวันที่ :date',
            'soon' => 'เร็วๆ นี้™',
        ],
    ],

    'states' => [
        'entry' => 'เปิดรับงาน',
        'voting' => 'เริ่มเปิดโหวต',
        'results' => 'ประกาศผล',
    ],

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
