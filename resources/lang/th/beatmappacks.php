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
    'index' => [
        'description' => 'แพ็คคอลเล็คชั่นของเพลงที่อยู่ในประเภทเดียวกัน',
        'nav_title' => '',
        'title' => 'แพ็คเกจ Beatmap',

        'blurb' => [
            'important' => 'กรุณาอ่านก่อนทำการดาวน์โหลด',
            'instruction' => [
                '_' => "การติดตั้ง : หลังจากคุณดาวน์โหลดไฟล์แล้ว, ให้แตกไฟล์นามสกุล .rar ลงไปในไฟล์ osu!\\Songs 
                    ไฟล์เพลงในแพ็คที่คุณโหลดมาจะติดนามสกุล .zip'd หรือ .osz'd ดังนั้น osu! จะทำการแตกไฟล์ beatmap เองครั้งต่อไปที่คุณเข้าไปเล่น
                    :scary ทำการแตกไฟล์ zip's/osz's ด้วยตัวคุณเอง ไม่เช่นนั้น beatmap ที่คุณติดตั้งมาจะไม่สามารถเข้าเล่นได้",
                'scary' => 'อย่า',
            ],
            'note' => [
                '_' => 'แล้วก็ทางเราแนะนำให้คุณ :scary, เนื่องจากคุณภาพของ beatmap สมัยก่อนนั้นต่ำกว่าในสมัยนี้',
                'scary' => 'ดาวน์โหลดไฟล์จากล่าสุดไปเก่าสุด',
            ],
        ],
    ],

    'show' => [
        'download' => 'ดาวน์โหลด',
        'item' => [
            'cleared' => 'ผ่านแล้ว',
            'not_cleared' => 'ยังไม่ผ่าน',
        ],
    ],

    'mode' => [
        'artist' => 'ศิลปิน/ผู้แต่ง',
        'chart' => 'ชาร์ท',
        'standard' => 'ทั่วไป',
        'theme' => 'ธีม',
    ],

    'require_login' => [
        '_' => 'คุณต้องทำการ :link เพื่อดาวน์โหลด',
        'link_text' => 'ลงชื่อเข้าใช้',
    ],
];
