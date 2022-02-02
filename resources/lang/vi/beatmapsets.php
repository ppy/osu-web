<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'availability' => [
        'disabled' => 'Hiện tại beatmap này không có sẵn để tải xuống.',
        'parts-removed' => 'Một phần của beatmap này đã bị xóa bỏ theo yêu cầu của người tạo lập hoặc bên người có quyền bên thứ ba.',
        'more-info' => 'Nhấp vào đây để biết thêm thông tin.',
        'rule_violation' => 'Một số nội dung có trong map này đã bị xóa sau khi bị đánh giá là không phù hợp để sử dụng trong osu!.',
    ],

    'download' => [
        'limit_exceeded' => 'Chậm lại, chơi nhiều hơn.',
    ],

    'featured_artist_badge' => [
        'label' => 'Nghệ sĩ nổi bật',
    ],

    'index' => [
        'title' => 'Danh Sách Beatmap',
        'guest_title' => 'Beatmaps',
    ],

    'panel' => [
        'empty' => 'không beatmaps',

        'download' => [
            'all' => 'tải xuống',
            'video' => 'tải xuống cùng video',
            'no_video' => 'tải xuống không video',
            'direct' => 'mở trong osu!direct',
        ],
    ],

    'nominate' => [
        'hybrid_requires_modes' => 'Bạn cần chọn ít nhất một chế độ chơi trong beatmap có nhiều chế độ để đề cử.',
        'incorrect_mode' => 'Bạn không có sự cho phép để đề cử cho chế độ: :mode',
        'full_bn_required' => 'Bạn phải là người được đề cử đầy đủ để thực hiện đề cử đủ điều kiện này.',
        'too_many' => 'Yêu cầu đề cử đã được đáp ứng.',

        'dialog' => [
            'confirmation' => 'Bạn có chắc chắn muốn đề cử beatmap này không?',
            'header' => 'Đề cử Beatmap',
            'hybrid_warning' => 'lưu ý: bạn chỉ có thể đề cử một lần, vì vậy hãy đảm bảo rằng bạn đang đề cử cho tất cả các chế độ chơi mà bạn dự định',
            'which_modes' => 'Đề cử cho những chế độ nào?',
        ],
    ],

    'nsfw_badge' => [
        'label' => '18+',
    ],

    'show' => [
        'discussion' => 'Góc Thảo Luận',

        'details' => [
            'by_artist' => 'bởi :artist',
            'favourite' => 'Yêu thích beatmapset này',
            'favourite_login' => 'Đăng nhập để yêu thích beatmap này',
            'logged-out' => 'Bạn cần phải đăng nhập trước khi tải xuống beatmap!',
            'mapped_by' => 'được tạo bởi :mapper',
            'unfavourite' => 'Bỏ yêu thích beatmapset này',
            'updated_timeago' => 'cập nhật lần cuối vào :timeago',

            'download' => [
                '_' => 'Tải Xuống',
                'direct' => '',
                'no-video' => 'không Video',
                'video' => 'cùng Video',
            ],

            'login_required' => [
                'bottom' => 'để truy cập vào nhiều tính năng hơn',
                'top' => 'Đăng Nhập',
            ],
        ],

        'details_date' => [
            'approved' => 'được chấp nhận :timeago',
            'loved' => 'loved :timeago',
            'qualified' => 'đủ tiêu chuẩn :timeago',
            'ranked' => 'được xếp hạng :timeago',
            'submitted' => 'được đăng :timeago',
            'updated' => 'cập nhật lần cuối :timeago',
        ],

        'favourites' => [
            'limit_reached' => 'Bạn có quá nhiều beatmap yêu thích! Hãy hủy yêu thích vài beatmap và thử lại sau.',
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
                '_' => 'Nếu bạn thấy có vấn đề với bản beatmap này, vui lòng loại bỏ nó :link.',
            ],

            'report' => [
                '_' => 'Nếu bạn tìm thấy vấn đề với beatmap này, vui lòng báo cáo nó tại :link để cảnh báo cho chúng tôi.',
                'button' => 'Báo cáo vấn đề',
                'link' => 'đây',
            ],
        ],

        'info' => [
            'description' => 'Mô Tả',
            'genre' => 'Thể Loại',
            'language' => 'Ngôn Ngữ',
            'no_scores' => 'Vẫn đang tính toán dữ liệu...',
            'nsfw' => 'Nội dung không lành mạnh',
            'points-of-failure' => 'Tỉ Lệ Thất Bại',
            'source' => 'Nguồn',
            'storyboard' => 'Beatmap này chứa storyboard',
            'success-rate' => 'Tỉ Lệ Thành Công',
            'tags' => 'Tags',
            'video' => 'Beatmap này chứa video',
        ],

        'nsfw_warning' => [
            'details' => 'Beatmap này chứa nội dung không lành mạn, phản cảm, hoặc đáng lo ngại. Bạn có muốn xem nó không?',
            'title' => 'Nội dung không lành mạnh',

            'buttons' => [
                'disable' => 'Ẩn thông báo',
                'listing' => 'Danh sách beatmap',
                'show' => 'Hiển thị',
            ],
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
                'pin' => 'Ghim',
                'player' => 'Người Chơi',
                'pp' => '',
                'rank' => 'Xếp Hạng',
                'score' => 'Điểm',
                'score_total' => 'Tổng Điểm',
                'time' => 'Thời gian',
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
            'ranked' => 'Đã được xếp hạng',
            'approved' => 'Được Chấp Nhận',
            'loved' => 'Được yêu thích',
            'qualified' => 'Qualified',
            'wip' => 'WIP',
            'pending' => 'Đang Chờ',
            'graveyard' => 'Graveyard',
        ],
    ],
];
