<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'page_description' => 'ศิลปินที่น่าสนใจบน osu!',
    'title' => 'ศิลปินโดดเด่น',

    'admin' => [
        'hidden' => 'ข้อมูลศิลปินคนนี้ถูกซ่อนอยู่',
    ],

    'beatmaps' => [
        '_' => 'บีทแมพ',
        'download' => 'ดาวน์โหลดตัวอย่างบีตแม็ป',
        'download-na' => 'ตัวอย่างบีทแมพนี้ยังไม่สามารถให้ใช้งานได้',
    ],

    'index' => [
        'description' => 'ศิลปินโดดเด่นคือศิลปินที่ทำงานร่วมกันกับเราเพื่อสร้างเพลงใหม่ และเพลงออริจินัลบน osu! ซึ่งทีมงาน osu! คัดเลือกศิลปินและเพลงของศิลปินอย่างดีเพราะความเจ๋งและเหมาะการทำบีตแมป ศิลปินที่โดดเด่นบางคนในกลุ่มนี้ยังสร้างเพลงใหม่ไว้เฉพาะกับ osu! ด้วย<br><br>เพลงเหล่านี้ได้กำหนดจังหวะไว้แล้วในไฟล์ .osz และได้รับอนุญาตกับ osu! เพื่อใช้ในเกมและเนื้อหาที่เกี่ยวข้อง',
    ],

    'links' => [
        'beatmaps' => 'osu! บีทแมพ',
        'osu' => 'โปรไฟล์ osu!',
        'site' => 'เว็บไซต์อย่างเป็นทางการ',
    ],

    'songs' => [
        '_' => 'เพลง',
        'count' => ':count_delimited เพลง|:count_delimited เพลง',
        'original' => 'osu! ต้นฉบับ',
        'original_badge' => 'ต้นฉบับ',
    ],

    'tracklist' => [
        'title' => 'ชื่อ',
        'length' => 'ระยะเวลา',
        'bpm' => 'bpm',
        'genre' => 'ประเภท',
    ],

    'tracks' => [
        'index' => [
            '_' => 'ค้นหาแทร็ก',

            'exclusive_only' => [
                'all' => 'ทั้งหมด',
                'exclusive_only' => 'osu! ต้นฉบับ',
            ],

            'form' => [
                'advanced' => 'การค้นหาขั้นสูง',
                'album' => 'อัลบั้ม',
                'artist' => 'ศิลปิน',
                'bpm_gte' => 'BPM ต่ำสุด',
                'bpm_lte' => 'BPM สูงสุด',
                'empty' => 'ไม่พบแทร็กที่ตรงกับเกณฑ์การค้นหา',
                'exclusive_only' => 'ประเภท',
                'genre' => 'ประเภท',
                'genre_all' => 'ทั้งหมด',
                'length_gte' => 'ความยาวต่ำสุด',
                'length_lte' => 'ความยาวสูงสุด',
            ],
        ],
    ],
];
