<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'null_user' => 'Bạn cần phải đăng nhập để chỉnh sửa.',
            'system_generated' => 'Không thể sửa bài đăng của hệ thống.',
            'wrong_user' => 'Chỉ chủ bài đăng mới được chỉnh sửa.',
        ],
    ],

    'events' => [
        'empty' => 'Chưa có gì... cả.',
    ],

    'nearby_posts' => [
        'confirm' => 'Không bài đăng nào đề cập đến vấn đề của tôi',
        'notice' => 'Có một vài bài đăng xung quanh :timestamp (:existing_timestamps). Hãy kiểm tra trước khi đăng.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Hãy đăng nhập để trả lời',
            'user' => 'Trả lời',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Đã được giải quyết bởi :user',
            'false' => 'Bị mở lại bởi :user',
        ],
    ],

    'user' => [
        'admin' => 'admin',
        'bng' => 'nominator',
        'owner' => 'mapper',
        'qat' => 'qat',
    ],
];
