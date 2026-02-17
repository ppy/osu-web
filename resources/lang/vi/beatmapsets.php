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

    'cover' => [
        'deleted' => 'Beatmap đã bị xóa',
    ],

    'download' => [
        'limit_exceeded' => 'Chậm lại, chơi nhiều hơn.',
        'no_mirrors' => 'Không có sẵn máy chủ tải xuống nào cả.',
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
        'bng_limited_too_many_rulesets' => 'Những người đề cử tập sự không thể đề cử nhiều ruleset cùng lúc.',
        'full_nomination_required' => 'Bạn phải là người đề cử chính để thực hiện đề cử cuối cùng của một ruleset.',
        'hybrid_requires_modes' => 'Bạn cần chọn ít nhất một chế độ chơi trong beatmap có nhiều chế độ để đề cử.',
        'incorrect_mode' => 'Bạn không có sự cho phép để đề cử cho chế độ: :mode',
        'invalid_limited_nomination' => 'Beatmap này có những đề cử không hợp lệ và không thể đủ tư cách trong trạng thái này.',
        'invalid_ruleset' => 'Đề cử này có các ruleset không hợp lệ.',
        'too_many' => 'Yêu cầu đề cử đã được đáp ứng.',
        'too_many_non_main_ruleset' => 'Yêu cầu đề cử cho ruleset không chính đã được đáp ứng.',

        'dialog' => [
            'confirmation' => 'Bạn có chắc chắn muốn đề cử beatmap này không?',
            'different_nominator_warning' => 'Việc đủ điều kiện cho beatmap này với các người đề cử khác sẽ làm reset vị trí trong hàng đợi đủ điều kiện của nó.',
            'header' => 'Đề cử Beatmap',
            'hybrid_warning' => 'lưu ý: bạn chỉ có thể đề cử một lần, vì vậy hãy đảm bảo rằng bạn đang đề cử cho tất cả các chế độ chơi mà bạn dự định',
            'current_main_ruleset' => 'Ruleset chính hiện tại là: :ruleset',
            'which_modes' => 'Đề cử cho những chế độ nào?',
        ],
    ],

    'nsfw_badge' => [
        'label' => '18+',
    ],

    'show' => [
        'discussion' => 'Góc Thảo Luận',

        'admin' => [
            'full_size_cover' => 'Xem ảnh bìa kích thước đầy đủ',
            'page' => 'Xem trang quản trị viên',
        ],

        'deleted_banner' => [
            'title' => 'Beatmap này đã bị xoá.',
            'message' => '(chỉ điều phối viên mới có thể thấy cái này)',
        ],

        'details' => [
            'by_artist' => 'bởi :artist',
            'favourite' => 'Yêu thích beatmapset này',
            'favourite_login' => 'Đăng nhập để yêu thích beatmap này',
            'logged-out' => 'Bạn cần phải đăng nhập trước khi tải xuống beatmap!',
            'mapped_by' => 'được tạo bởi :mapper',
            'mapped_by_guest' => 'độ khó khách bởi :mapper',
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
            'loved' => 'được yêu mến :timeago',
            'qualified' => 'đủ tư cách :timeago',
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
                    'pending' => 'đang chờ',
                    'qualified' => 'đủ tư cách',
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
            'mapper_tags' => 'Thẻ người tạo bản đồ',
            'no_scores' => 'Vẫn đang tính toán dữ liệu...',
            'nominators' => 'Người đề cử',
            'nsfw' => 'Nội dung không lành mạnh',
            'offset' => 'Offset online',
            'pack_tags' => '',
            'points-of-failure' => 'Tỉ Lệ Thất Bại',
            'source' => 'Nguồn',
            'storyboard' => 'Beatmap này chứa storyboard',
            'success-rate' => 'Tỉ Lệ Thành Công',
            'success_rate_plays' => '',
            'user_tags' => 'Thẻ người dùng',
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
            'error' => 'Tải xếp hạng thất bại',
            'friend' => 'Hạng Bạn Bè',
            'global' => 'Hạng Toàn Cầu',
            'supporter-link' => 'Nhấp vào <a href=":link">đây</a> để biết thêm những tính năng bạn có thể nhận!',
            'supporter-only' => 'Bạn cần là người ủng hộ để truy cập xếp hạng bạn bè và quốc gia!',
            'team' => 'Xếp hạng đội',
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
                'score' => 'Số điểm',
                'score_total' => 'Tổng điểm',
                'time' => 'Thời gian',
            ],

            'no_scores' => [
                'country' => 'Chưa có ai từ quốc gia của bạn lập điểm số tại beatmap này!',
                'friend' => 'Chưa có bạn bè nào của bạn lập điểm số tại beatmap này!',
                'global' => 'Chưa có điểm số. Hãy thử lập một vài điểm số xem?',
                'loading' => 'Đang tải điểm số...',
                'team' => 'Chưa có ai từ đội của bạn lập điểm số tại beatmap này!',
                'unranked' => 'Beatmap chưa được xếp hạng.',
            ],
            'score' => [
                'first' => 'Dẫn Đầu',
                'own' => 'Tốt Nhất Của Bạn',
            ],
            'supporter_link' => [
                '_' => 'Nháy vào :here để xem tất cả tính năng đặc biệt mà bạn có được!',
                'here' => 'đây',
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
            'offset' => 'Offset online: :offset',
            'user-rating' => 'Đánh Giá',
            'rating-spread' => 'Phân Loại Đánh Giá',
            'nominations' => 'Đề cử',
            'playcount' => 'Đã chơi',
            'favourites' => 'Mục ưa thích',
            'no_favourites' => 'Hiện chưa có mục yêu thích',
        ],

        'status' => [
            'ranked' => 'Đã được xếp hạng',
            'approved' => 'Được Chấp Nhận',
            'loved' => 'Được yêu mến',
            'qualified' => 'Đủ tư cách',
            'wip' => 'WIP',
            'pending' => 'Đang Chờ',
            'graveyard' => 'Đắp mộ',
        ],
    ],

    'spotlight_badge' => [
        'label' => 'Tiêu điểm',
    ],
];
