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
    'show' => [
        'fallback_translation' => 'หน้าที่คุณเรียกยังไม่ถูกแปลในภาษาที่เลือกอยู่ (:language) กำลังแสดงเนื้อหาฉบับภาษาอังกฤษ',
        'incomplete_or_outdated' => 'เนื้อหาในหน้านี้ยังเขียนไม่เสร็จหรือเก่าไป ถ้าหากคุณช่วยได้ ให้ลองมาแก้ไขบทความนี้',
        'missing' => 'ไม่พบหน้า ":keyword" ที่คุณเรียก',
        'missing_title' => 'ไม่พบ',
        'missing_translation' => 'หน้าที่คุณเรียกไม่สามารถหาพบเจอได้ในภาษาที่คุณเรียกอยู่ในขณะนี้',
        'needs_cleanup_or_rewrite' => 'หน้านี้ไม่ผ่านมาตรฐานของ osu! wiki และต้องการการปรับปรุงหรือเขียนใหม่ หากคุณช่วยได้ ก็ช่วยหน่อย',
        'search' => 'ค้นหาหน้าที่มีอยู่สำหรับ :link.',
        'toc' => 'เนื้อหา',

        'edit' => [
            'link' => 'แสดงใน GitHub',
            'refresh' => 'รีเฟรช',
        ],

        'translation' => [
            'legal' => 'การแปลที่เห็นมีไว้เพื่อความสะดวกในการอ่านเท่านั้น ต้นฉบับ :default คือข้อความที่ถูกต้องที่สุด',
            'outdated' => 'หน้านี้มีเนื้อหาที่แปลแล้วแต่ยังไม่ถูกปรับปรุงแก้ไข โปรดตรวจสอบ :default เพื่อข้อมูลที่ถูกต้องที่สุด (และพิจารณาอัปเดตเกี่ยวกับการแปลหากคุณสามารถช่วยเหลือได้)!',

            'default' => 'ฉบับภาษาอังกฤษ',
        ],
    ],
    'main' => [
        'title' => '',
        'subtitle' => 'เพราะชื่อ osu!pedia ไม่ค่อยเหมาะเท่าไหร่',
    ],
];
