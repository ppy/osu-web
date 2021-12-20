<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'header' => [
        'small' => 'Cạnh tranh bằng nhiều cách khác nhau hơn là chỉ bấm vòng tròn.',
        'large' => 'Cuộc Thi Cộng Đồng',
    ],

    'index' => [
        'nav_title' => 'danh sách',
    ],

    'voting' => [
        'login_required' => 'Hãy đăng nhập để bình chọn.',
        'over' => 'Bình chọn đã kết thúc cho cuộc thi này',
        'show_voted_only' => 'Xem lượt bình chọn',

        'best_of' => [
            'none_played' => "Dường như bạn chưa chơi bất kì beatmap nào đủ điều kiện cho cuộc thi này!",
        ],

        'button' => [
            'add' => 'Bỏ phiếu',
            'remove' => 'Hủy phiếu',
            'used_up' => 'Bạn đã dùng tất cả phiếu bầu',
        ],

        'progress' => [
            '_' => ':used / :max người dùng bình chọn',
        ],
    ],
    'entry' => [
        '_' => 'entry',
        'login_required' => 'Hãy đăng nhập để tham gia cuộc thi.',
        'silenced_or_restricted' => 'Bạn không thể tham gia cuộc thi trong khi bị hạn chế hoặc bị im lặng.',
        'preparation' => 'Chúng tôi đang chuẩn bị cho cuộc thi này. Xin hãy kiên nhẫn chờ đợi!',
        'drop_here' => 'Thả bài dự thi của bạn vào đây',
        'download' => 'Tải xuống .osz',
        'wrong_type' => [
            'art' => 'Chỉ những file .jpg và .png mới được chấp nhận cho cuộc thi này.',
            'beatmap' => 'Chỉ những file .osu mới được chấp nhận cho cuộc thi này.',
            'music' => 'Chỉ những file .mp3 mới được chấp nhận cho cuộc thi này.',
        ],
        'too_big' => 'Số bài dự thi cho cuộc thi này tối đa là :limit.',
    ],
    'beatmaps' => [
        'download' => 'Tải Xuống Bài Dự Thi',
    ],
    'vote' => [
        'list' => 'phiếu',
        'count' => ':count phiếu',
        'points' => ':count điểm',
    ],
    'dates' => [
        'ended' => 'Đã kết thúc :date',
        'ended_no_date' => 'Đã dừng',

        'starts' => [
            '_' => 'Bắt đầu :date',
            'soon' => 'soon™',
        ],
    ],
    'states' => [
        'entry' => 'Nhận Bài Dự Thi',
        'voting' => 'Bắt Đầu Bình Chọn',
        'results' => 'Đã Có Kết Quả',
    ],
];
