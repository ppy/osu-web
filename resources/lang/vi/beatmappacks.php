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
    'index' => [
        'description' => 'Sưu tầm những map được đóng gói sẵn dựa trên chủ đề chung.',
        'nav_title' => '',
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
