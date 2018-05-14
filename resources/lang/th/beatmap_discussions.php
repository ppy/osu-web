<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'authorizations' => [
        'update' => [
            'null_user' => 'ต้องเข้าสู่ระบบก่อนที่จะแก้ไข',
            'system_generated' => 'ไม่สามารถแก้โพสจากระบบได้',
            'wrong_user' => 'เจ้าของโพสเท่านั้นที่จะสามารถแก้ไขได้',
        ],
    ],

    'events' => [
        'empty' => 'ยังไม่มีอะไรเลย...ใช่ นั่นแหล่',
    ],

    'index' => [
        'deleted_beatmap' => 'ลบไปแล้ว',
        'title' => '',

        'form' => [
            'deleted' => '',

            'user' => [
                'label' => 'ผู้ใช้',
                'overview' => '',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'โพสเมื่อวันที่',
        'deleted_at' => 'ถูกลบเมื่อวันที่',
        'message_type' => 'ประเภท',
        'permalink' => 'ลิงค์',
    ],

    'nearby_posts' => [
        'confirm' => '',
        'notice' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'เข้าสู่ระบบเพื่อตอบกลับ',
            'user' => 'ตอบกลับ',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'ตั้งสถานะได้รับการแก้ไขแล้วโดย :user',
            'false' => 'ถูกเปิดใหม่โดย :user',
        ],
    ],

    'user' => [
        'admin' => '',
        'bng' => '',
        'owner' => '',
        'qat' => '',
    ],

    'user_filter' => [
        'everyone' => '',
        'label' => '',
    ],
];
