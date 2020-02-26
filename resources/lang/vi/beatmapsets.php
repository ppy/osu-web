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
    'availability' => [
        'disabled' => 'Hiện tại beatmap này không có sẵn để tải xuống.',
        'parts-removed' => 'Một phần của beatmap này đã bị xóa bỏ theo yêu cầu của người tạo lập hoặc bên người có quyền bên thứ ba.',
        'more-info' => 'Nhấp vào đây để biết thêm thông tin.',
    ],

    'index' => [
        'title' => 'Danh Sách Beatmap',
        'guest_title' => 'Beatmaps',
    ],

    'show' => [
        'discussion' => 'Góc Thảo Luận',

        'details' => [
            'favourite' => 'Yêu thích beatmapset này',
            'logged-out' => 'Bạn cần phải đăng nhập trước khi tải xuống beatmap!',
            'mapped_by' => 'được tạo bởi :mapper',
            'unfavourite' => 'Bỏ yêu thích beatmapset này',
            'updated_timeago' => 'cập nhật lần cuối vào :timeago',

            'download' => [
                '_' => 'Tải Xuống',
                'direct' => 'osu!direct',
                'no-video' => 'không Video',
                'video' => 'cùng Video',
            ],

            'login_required' => [
                'bottom' => 'để truy cập vào nhiều tính năng hơn',
                'top' => 'Đăng Nhập',
            ],
        ],

        'favourites' => [
            'limit_reached' => 'Bạn có quá nhiều beatmap yêu thích! Hãy hũy yêu thích vài beatmap và thử lại sau.',
        ],

        'hype' => [
            'action' => 'Hype nếu bạn thích map này để giúp nó tiến tới trạng thái <strong>Được xếp hạng</strong>.',

            'current' => [
                '_' => 'Map này đang ở trạng thái :status.',

                'status' => [
                    'pending' => 'chờ',
                    'qualified' => 'qualified',
                    'wip' => 'đang thực hiện',
                ],
            ],

            'disqualify' => [
                '_' => '',
                'button_title' => '',
            ],

            'report' => [
                '_' => '',
                'button' => '',
                'button_title' => '',
                'link' => '',
            ],
        ],

        'info' => [
            'description' => 'Mô Tả',
            'genre' => 'Thể Loại',
            'language' => 'Ngôn Ngữ',
            'no_scores' => 'Vẫn đang tính toán dữ liệu...',
            'points-of-failure' => 'Tỉ Lệ Thất Bại',
            'source' => 'Nguồn',
            'success-rate' => 'Tỉ Lệ Thành Công',
            'tags' => 'Tags',
            'unranked' => 'Beatmap chưa được xếp hạng',
        ],

        'scoreboard' => [
            'achieved' => 'đạt được :when',
            'country' => 'Hạng Quốc Gia',
            'friend' => 'Hạng Bạn Bè',
            'global' => 'Hạng Toàn Cầu',
            'supporter-link' => 'Nhấp vào <a href=":link">đây</a> để biết thêm những tính năng bạn có thể nhận!',
            'supporter-only' => 'Bạn cần là người ủng hộ để truy cập xếp hạng bạn bè và quốc gia!',
            'title' => 'Bảng Xếp hạng',

            'headers' => [
                'accuracy' => 'Độ Chính Xác',
                'combo' => 'Combo Tối Đa',
                'miss' => 'Miss',
                'mods' => 'Mods',
                'player' => 'Người Chơi',
                'pp' => 'pp',
                'rank' => 'Xếp Hạng',
                'score_total' => 'Tổng Điểm',
                'score' => 'Điểm',
            ],

            'no_scores' => [
                'country' => 'Chưa có ai từ quốc gia của bạn lập điểm số tại beatmap này!',
                'friend' => 'Chưa có bạn bè nào của bạn lập điểm số tại beatmap này!',
                'global' => 'Chưa có điểm số. Hãy thử lập một vài điểm số xem?',
                'loading' => 'Đang tải điểm số...',
                'unranked' => 'Beatmap chưa được xếp hạng.',
            ],
            'score' => [
                'first' => 'Dẫn Đầu',
                'own' => 'Tốt Nhất Của Bạn',
            ],
        ],

        'stats' => [
            'cs' => 'Kích Cỡ Nốt',
            'cs-mania' => 'Số Phím',
            'drain' => 'Độ Giảm HP',
            'accuracy' => 'Độ Chính Xác',
            'ar' => 'Tốc Độ Tiếp Cận',
            'stars' => 'Độ Khó',
            'total_length' => 'Độ Dài',
            'bpm' => 'BPM',
            'count_circles' => 'Số Nốt Bấm',
            'count_sliders' => 'Số Nốt Trượt',
            'user-rating' => 'Đánh Giá',
            'rating-spread' => 'Phân Loại Đánh Giá',
            'nominations' => 'Đề cử',
            'playcount' => 'Đã chơi',
        ],

        'status' => [
            'ranked' => '',
            'approved' => '',
            'loved' => '',
            'qualified' => '',
            'wip' => '',
            'pending' => '',
            'graveyard' => '',
        ],
    ],
];
