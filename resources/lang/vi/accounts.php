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
        'title' => 'Thông báo',
        'topic_auto_subscribe' => 'tự động nhận thông báo cho các topic bạn tạo trong forum',
        'beatmapset_discussion_qualified_problem' => '',

        'mail' => [
            '_' => '',
            'beatmapset:modding' => '',
            'forum_topic_reply' => '',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '',
        'own_clients' => '',
        'title' => 'OAuth',
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
