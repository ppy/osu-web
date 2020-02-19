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
    'authorizations' => [
        'update' => [
            'null_user' => 'Cần phải đăng nhập để chỉnh sửa.',
            'system_generated' => 'Không thể chỉnh sửa bài đăng được tạo bởi hệ thống.',
            'wrong_user' => 'Chỉ chủ bài đăng mới được chỉnh sửa.',
        ],
    ],

    'events' => [
        'empty' => 'Chưa có gì xảy ra cả.',
    ],

    'index' => [
        'deleted_beatmap' => 'đã xóa',
        'title' => 'Góc Thảo Luận Beatmap',

        'form' => [
            '_' => 'Tìm kiếm',
            'deleted' => 'Bao gồm cuộc thảo luận đã xóa',
            'only_unresolved' => '',
            'types' => 'Kiểu thư',
            'username' => 'Tên người dùng',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'Người dùng',
                'overview' => 'Tổng quan hoạt động',
            ],
        ],
    ],

    'item' => [
        'created_at' => 'Ngày đăng',
        'deleted_at' => 'Ngày xóa',
        'message_type' => 'Loại',
        'permalink' => 'Permalink',
    ],

    'nearby_posts' => [
        'confirm' => 'Không bài đăng nào đề cập đến vấn đề của tôi',
        'notice' => 'Có một vài bài đăng vào khoảng :timestamp (:existing_timestamps). Hãy xem chúng trước khi đăng.',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Hãy đăng nhập để trả lời',
            'user' => 'Trả lời',
        ],
    ],

    'review' => [
        'go_to_parent' => '',
        'go_to_child' => '',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Đã đánh dấu là được giải quyết bởi :user',
            'false' => 'Đã mở lại bởi :user',
        ],
    ],

    'timestamp_display' => [
        'general' => '',
        'general_all' => '',
    ],

    'user_filter' => [
        'everyone' => 'Mọi người',
        'label' => 'Lọc theo người dùng',
    ],
];
