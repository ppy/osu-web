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

    'judge' => [
        'comments' => 'bình luận',
        'hide_judged' => 'ẩn các bài thi đã được đánh giá',
        'nav_title' => 'đánh giá',
        'no_current_vote' => 'bạn vẫn chưa bầu chọn.',
        'update' => 'cập nhật',
        'validation' => [
            'missing_score' => 'chưa có điểm',
            'contest_vote_judged' => 'không thể bầu chọn trong các cuộc thi được đánh giá',
        ],
        'voted' => 'Bạn đã bình chọn cho bài dự thi này.',
    ],

    'judge_results' => [
        '_' => 'Kết quả đánh giá',
        'creator' => 'tác giả',
        'score' => 'Điểm',
        'score_std' => 'Điểm hàng loạt',
        'total_score' => 'tổng điểm',
        'total_score_std' => 'tổng điểm hàng loạt',
    ],

    'voting' => [
        'judge_link' => 'Bạn là giám khảo của cuộc thi này. Đánh giá các bài thi ở đây!',
        'judged_notice' => 'Cuộc thi này sử dụng hệ thống đánh giá, các giám khảo đang xử lý các bài thi.',
        'login_required' => 'Hãy đăng nhập để bình chọn.',
        'over' => 'Cuộc bình chọn cho cuộc thi này đã kết thúc',
        'show_voted_only' => 'Hiện bài đã bình chọn',

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

        'requirement' => [
            'playlist_beatmapsets' => [
                'incomplete_play' => 'Phải chơi hết tất cả beatmap trong playlist cụ thể trước khi bình chọn',
            ],
        ],
    ],

    'entry' => [
        '_' => 'bài dự thi',
        'login_required' => 'Hãy đăng nhập để tham gia cuộc thi.',
        'silenced_or_restricted' => 'Bạn không thể tham gia cuộc thi trong khi bị hạn chế hoặc bị im lặng.',
        'preparation' => 'Chúng tôi đang chuẩn bị cho cuộc thi này. Xin hãy kiên nhẫn chờ đợi!',
        'drop_here' => 'Thả bài dự thi của bạn vào đây',
        'download' => 'Tải xuống .osz',

        'wrong_type' => [
            'art' => 'Chỉ những tệp .jpg và .png mới được chấp nhận cho cuộc thi này.',
            'beatmap' => 'Chỉ những tệp .osu mới được chấp nhận cho cuộc thi này.',
            'music' => 'Chỉ những tệp .mp3 mới được chấp nhận cho cuộc thi này.',
        ],

        'wrong_dimensions' => 'Bài dự thi cho cuộc thi này phải có :widthx:height',
        'too_big' => 'Số bài dự thi cho cuộc thi này tối đa là :limit.',
    ],

    'beatmaps' => [
        'download' => 'Tải Xuống Bài Dự Thi',
    ],

    'vote' => [
        'list' => 'phiếu',
        'count' => ':count phiếu',
        'points' => ':count điểm',
        'points_float' => ':points điểm',
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

    'show' => [
        'admin' => [
            'page' => '',
        ],
    ],
];
