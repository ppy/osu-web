<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => 'Không có lịch sử nhóm được tìm thấy!',
    'view' => 'Xem lịch sử nhóm',

    'event' => [
        'actor' => 'bởi :user',

        'message' => [
            'group_add' => 'Đã tạo:group.',
            'group_remove' => 'Đã xoá:group.',
            'group_rename' => ':previous_group đã được đặt lại tên thành :group.',
            'user_add' => ':user đã được thêm vào :group.',
            'user_add_with_playmodes' => ':user đã được thêm vào :group cho :rulesets.',
            'user_add_playmodes' => ':rulesets đã được thêm vào tư cách thành viên :group của :user.',
            'user_remove' => ':user đã được xóa khỏi :group.',
            'user_remove_playmodes' => ':rulesets đã bị gỡ khỏi tư cách thành viên :group của :user.',
            'user_set_default' => ':user được đặt nhóm mặc định thành :group.',
        ],
    ],

    'form' => [
        'group' => 'Nhóm',
        'group_all' => 'Tất cả các nhóm',
        'max_date' => 'Từ',
        'min_date' => 'Đến',
        'user' => 'Người dùng',
        'user_prompt' => 'Tên người dùng hoặc ID',
    ],

    'staff_log' => [
        '_' => 'Lịch sử nhóm cũ hơn có thể được tìm thấy ở :wiki_articles.',
        'wiki_articles' => 'Các bài viết wiki về nhật ký staff',
    ],
];
