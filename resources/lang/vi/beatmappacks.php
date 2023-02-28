<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'index' => [
        'description' => 'Sưu tầm những map được đóng gói sẵn dựa trên chủ đề chung.',
        'nav_title' => 'danh sách',
        'title' => 'Gói Beatmap',

        'blurb' => [
            'important' => 'HÃY ĐỌC TRƯỚC KHI TẢI',
            'install_instruction' => 'Cài đặt: Một khi gói đã được tải xuống, hãy giải nén nội dung của gói vào thư mục Songs trong osu! của bạn và osu! sẽ lo nốt phần còn lại.',
            'note' => [
                '_' => 'Cũng lưu ý rằng nên :scary, vì những map cũ có chất lượng thấp hơn những map mới.',
                'scary' => 'tải những gói từ mới nhất đến cũ nhất',
            ],
        ],
    ],

    'show' => [
        'download' => 'Tải Xuống',
        'item' => [
            'cleared' => 'đã chơi',
            'not_cleared' => 'chưa chơi',
        ],
        'no_diff_reduction' => [
            '_' => ':link liên kết không thể sử dụng để qua gói này.',
            'link' => 'Mods làm giảm độ khó',
        ],
    ],

    'mode' => [
        'artist' => 'Nghệ Sĩ/Album',
        'chart' => 'Tiêu điểm',
        'standard' => 'Tiêu Chuẩn',
        'theme' => 'Chủ Đề',
    ],

    'require_login' => [
        '_' => 'Bạn cần phải :link để tải xuống',
        'link_text' => 'đăng nhập',
    ],
];
