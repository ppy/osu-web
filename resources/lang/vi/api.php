<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'error' => [
        'chat' => [
            'empty' => 'Không thể gửi tin nhắn không chứa ký tự.',
            'limit_exceeded' => 'Bạn đang gửi tin nhắn quá nhanh, hãy đợi một lát trước khi thử lại.',
            'too_long' => 'Tin nhắn bạn đang cố gửi quá dài.',
        ],
    ],

    'scopes' => [
        'bot' => 'Hành xử như chat bot.',
        'identify' => 'Nhận diện và đọc trang cá nhân công khai của bạn.',

        'chat' => [
            'write' => 'Gửi tin nhắn dưới tư cách của bạn.',
        ],

        'forum' => [
            'write' => 'Tạo và chỉnh sửa các chủ đề, bài đăng trên diễn đàn thay mặt bạn.',
        ],

        'friends' => [
            'read' => 'Xem những ai bạn đang theo dõi.',
        ],

        'public' => 'Đọc dữ liệu công khai nhân danh bạn.',
    ],
];
