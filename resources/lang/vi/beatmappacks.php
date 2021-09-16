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
            'instruction' => [
                '_' => "Cài đặt: Mỗi khi bạn tải xuống một gói, giải nén file .rar vào thư mục Songs của osu!.
                    Tất cả nhạc vẫn còn giữ ở dạng .zip và/hoặc .osz trong gói, nên osu! sẽ phải giải nén beatmap vào lần tới bạn vào Chế độ chơi (Play mode).
                    :scary tự giải nén những file .zip/.osz, nếu không beatmap sẽ không hiển thị đúng trong osu! và sẽ không hoạt động đúng cách.",
                'scary' => 'ĐỪNG',
            ],
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
