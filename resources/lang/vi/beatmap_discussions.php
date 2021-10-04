<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => 'Bạn cần phải đăng nhập để chỉnh sửa nó',
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
            'mode' => 'Chế độ Beatmap',
            'only_unresolved' => 'Chỉ hiện các cuộc thảo luận chưa được giải quyết',
            'types' => 'Kiểu tin nhắn',
            'username' => 'Tên người dùng',

            'beatmapset_status' => [
                '_' => 'Tình trạng Beatmap',
                'all' => 'Tất cả',
                'disqualified' => 'Bị Loại',
                'never_qualified' => 'Chưa bao giờ Đủ Điều Kiện',
                'qualified' => 'Đủ Điều Kiện',
                'ranked' => 'Xếp Hạng',
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
        'permalink' => 'Liên Kết Tĩnh',
    ],

    'nearby_posts' => [
        'confirm' => 'Không bài đăng nào đề cập đến vấn đề của tôi',
        'notice' => 'Có một vài bài đăng vào khoảng :timestamp
(:existing_timestamps). Hãy xem chúng trước khi đăng.',
        'unsaved' => ':count trong bài đánh giá này',
    ],

    'owner_editor' => [
        'button' => 'Chủ Sở Hữu Độ Khó',
        'reset_confirm' => 'Đặt lại chủ sở hữu cho khó khăn này?',
        'user' => 'Chủ Sở hữu',
        'version' => 'Khó Khăn',
    ],

    'reply' => [
        'open' => [
            'guest' => 'Hãy đăng nhập để trả lời',
            'user' => 'Trả lời',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max khối được sử dụng',
        'go_to_parent' => 'Xem Bài viết Đánh giá',
        'go_to_child' => 'Xem cuộc thảo luận',
        'validation' => [
            'block_too_large' => 'mỗi khối chỉ có thể chứa tối đa :limit giới hạn kí tự',
            'external_references' => 'bài đánh giá có chứa tham chiếu đến các vấn đề không thuộc bài đánh giá này',
            'invalid_block_type' => 'Loại khối không hợp lệ',
            'invalid_document' => 'đánh giá không phù hợp',
            'invalid_discussion_type' => 'loại thảo luận không hợp lệ',
            'minimum_issues' => 'đánh giá phải chứa tối thiểu :count vấn_đề|đánh_giá phải chứa tối thiểu :count vấn đề',
            'missing_text' => 'khối bị thiếu văn bản',
            'too_many_blocks' => 'đánh giá chỉ có thể chứa :count đoạn_văn/vấn_đề|đanh_giá chỉ có thể chứa tối đa :count đoạn_văn/vấn_đề',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => 'Đã giải quyết bởi :user',
            'false' => 'Đã mở lại bởi :user',
        ],
    ],

    'timestamp_display' => [
        'general' => 'Chung',
        'general_all' => 'Chung (tất cả)',
    ],

    'user_filter' => [
        'everyone' => 'Mọi người',
        'label' => 'Lọc theo người dùng',
    ],
];
