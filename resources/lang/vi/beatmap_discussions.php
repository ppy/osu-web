<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

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
        'none_found' => 'Không có cuộc thảo luận nào khớp với bộ lọc tìm kiếm.',
        'title' => 'Góc Thảo Luận Beatmap',

        'form' => [
            '_' => 'Tìm kiếm',
            'deleted' => 'Bao gồm cuộc thảo luận đã xóa',
            'mode' => '',
            'only_unresolved' => 'Chỉ hiện các cuộc thảo luận chưa được giải quyết',
            'types' => 'Kiểu tin nhắn',
            'username' => 'Tên người dùng',

            'beatmapset_status' => [
                '_' => 'Tình trạng Beatmap',
                'all' => 'Tất cả',
                'disqualified' => 'Disqualified ',
                'never_qualified' => 'Chưa bao giờ Qualified',
                'qualified' => 'Qualified',
                'ranked' => 'Ranked',
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
        'unsaved' => ':count trong bài đánh giá này',
    ],

    'owner_editor' => [
        'button' => '',
        'reset_confirm' => '',
        'user' => '',
        'version' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Hãy đăng nhập để trả lời',
            'user' => 'Trả lời',
        ],
    ],

    'review' => [
        'block_count' => '',
        'go_to_parent' => 'Xem Bài viết Đánh giá',
        'go_to_child' => 'Xem cuộc thảo luận',
        'validation' => [
            'block_too_large' => '',
            'external_references' => '',
            'invalid_block_type' => '',
            'invalid_document' => 'đánh giá không phù hợp',
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
