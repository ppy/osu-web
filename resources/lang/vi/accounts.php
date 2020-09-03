<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'cài đặt',
        'username' => 'tên người dùng',

        'avatar' => [
            'title' => 'Ảnh đại diện',
            'rules' => 'Hãy chắc rằng ảnh đại diện của bạn tuân thủ :link.<br/>Điều này có nghĩa rằng ảnh phải <strong>phù hợp với mọi lứa tuổi</strong>. Ví dụ như không có nội dung khỏa thân, thô tục hoặc gợi tưởng.',
            'rules_link' => 'những tiêu chuẩn cộng đồng',
        ],

        'email' => [
            'current' => 'Email hiện tại',
            'new' => 'email mới',
            'new_confirmation' => 'xác nhận email',
            'title' => 'Email',
        ],

        'password' => [
            'current' => 'mật khẩu hiện tại',
            'new' => 'mật khẩu mới',
            'new_confirmation' => 'xác nhận mật khẩu',
            'title' => 'Mật khẩu',
        ],

        'profile' => [
            'title' => 'Trang cá nhân',

            'user' => [
                'user_discord' => 'discord',
                'user_from' => 'vị trí hiện tại',
                'user_interests' => 'sở thích',
                'user_msnm' => 'skype',
                'user_occ' => 'nghề nghiệp',
                'user_twitter' => 'twitter',
                'user_website' => 'trang web',
            ],
        ],

        'signature' => [
            'title' => 'Chữ kí',
            'update' => 'cập nhật',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => '',
        'beatmapset_disqualify' => 'nhận thông báo khi beatmap ở các chế độ sau bị disqualified',
        'comment_reply' => '',
        'title' => 'Thông báo',
        'topic_auto_subscribe' => 'tự động nhận thông báo cho các topic bạn tạo trong forum',

        'options' => [
            '_' => '',
            'beatmapset:modding' => '',
            'channel_message' => '',
            'comment_new' => '',
            'forum_topic_reply' => '',
            'mail' => '',
            'push' => '',
            'user_achievement_unlock' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '',
        'own_clients' => 'client đã có',
        'title' => 'OAuth',
    ],

    'options' => [
        'title' => '',

        'beatmapset_download' => [
            '_' => '',
            'all' => '',
            'no_video' => '',
            'direct' => '',
        ],

        'beatmapset_title_show_original' => 'hiển thị metadata của beatmap trong ngôn ngữ gốc',
    ],

    'playstyles' => [
        'keyboard' => 'bàn phím',
        'mouse' => 'chuột',
        'tablet' => 'tablet',
        'title' => 'Lối Chơi',
        'touch' => 'cảm ứng',
    ],

    'privacy' => [
        'friends_only' => 'chặn tin nhắn từ những người không có trong danh sách bạn bè của bạn',
        'hide_online' => 'Ẩn sự xuất hiện của bạn khi bạn online',
        'title' => 'Quyền Riêng Tư',
    ],

    'security' => [
        'current_session' => 'hiện tại',
        'end_session' => 'Kết thúc Phiên',
        'end_session_confirmation' => 'Việc này sẽ ngay lập tức kết thúc phiên của bạn trên thiết bị đó. Bạn có chắc không?',
        'last_active' => 'Hoạt động lần cuối:',
        'title' => 'Bảo mật',
        'web_sessions' => 'phiên trên web',
    ],

    'update_email' => [
        'update' => 'cập nhật',
    ],

    'update_password' => [
        'update' => 'cập nhật',
    ],

    'verification_completed' => [
        'text' => 'Bây giờ bạn có thể đóng cửa sổ này',
        'title' => 'Tài khoản đã được xác minh',
    ],

    'verification_invalid' => [
        'title' => 'Đường dẫn xác minh tài khoản không hợp lệ hoặc hết hạn',
    ],
];
