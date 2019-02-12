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
        'title' => 'Cài đặt <strong>Tài khoản</strong>',
        'title_compact' => 'cài đặt',
        'username' => 'tên người dùng',

        'avatar' => [
            'title' => 'Ảnh đại diện',
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
            'title' => 'Mật Khẩu',
        ],

        'profile' => [
            'title' => 'Trang cá nhân',

            'user' => [
                'user_from' => 'vị trí hiện tại',
                'user_interests' => 'sở thích',
                'user_msnm' => 'skype',
                'user_occ' => 'nghề nghiệp',
                'user_twitter' => 'twitter',
                'user_website' => 'trang web',
                'user_discord' => 'discord',
            ],
        ],

        'signature' => [
            'title' => 'Chữ kí',
            'update' => 'cập nhật',
        ],
    ],

    'update_email' => [
        'email_subject' => 'Xác nhận thay đổi email osu!',
        'update' => 'cập nhật',
    ],

    'update_password' => [
        'email_subject' => 'Xác nhận thay đổi mật khẩu osu!',
        'update' => 'cập nhật',
    ],

    'playstyles' => [
        'title' => 'Lối Chơi',
        'mouse' => 'chuột',
        'keyboard' => 'bàn phím',
        'tablet' => 'tablet',
        'touch' => 'touchscreen',
    ],

    'privacy' => [
        'title' => 'Quyền Riêng Tư',
        'friends_only' => 'chặn tin nhắn từ những người không có trong danh sách bạn bè của bạn',
        'hide_online' => 'ẩn sự hoạt động trực tuyến của bạn',
    ],

    'security' => [
        'current_session' => 'hiện tại',
        'end_session' => 'Kết thúc Phiên',
        'end_session_confirmation' => 'Việc này sẽ ngay lập tức kết thúc phiên của bạn trên thiết bị đó. Bạn chắc chứ?',
        'last_active' => 'Hoạt động lần cuối:',
        'title' => 'Bảo mật',
        'web_sessions' => 'phiên trên web',
    ],
];
