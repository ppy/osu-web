<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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

    'system' => [
        'resolved' => [
            'true' => 'Đã đánh dấu là được giải quyết bởi :user',
            'false' => 'Đã mở lại bởi :user',
        ],
    ],

    'user_filter' => [
        'everyone' => 'Mọi người',
        'label' => 'Lọc theo người dùng',
    ],
];
