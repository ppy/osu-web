<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'discussion-posts' => [
        'store' => [
            'error' => 'Lưu bài viết thất bại',
        ],
    ],

    'discussion-votes' => [
        'update' => [
            'error' => 'Cập nhật vote thất bại',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'cho phép kudosu',
        'delete' => 'xóa',
        'deleted' => 'Đã xóa bởi :editor :delete_time.',
        'deny_kudosu' => 'từ chối kudosu',
        'edit' => 'chỉnh sửa',
        'edited' => 'Sửa đổi lần cuối bởi :editor :update_time.',
        'kudosu_denied' => 'Đã từ chối nhận kudosu.',
        'message_placeholder_deleted_beatmap' => 'Difficulty này đã bị xóa nên nó có thể sẽ không còn được thảo luận nữa.',
        'message_type_select' => 'Chọn Loại Nhận Xét',
        'reply_notice' => 'Nhấn enter để trả lời.',
        'reply_placeholder' => 'Nhập câu trả lời của bạn tại đây',
        'require-login' => 'Hãy đăng nhập để đăng hoặc trả lời',
        'resolved' => 'Đã giải quyết',
        'restore' => 'hoàn lại',
        'title' => 'Góc Thảo Luận',

        'collapse' => [
            'all-collapse' => 'Thu gọn tất cả',
            'all-expand' => 'Mở rộng tất cả',
        ],

        'empty' => [
            'empty' => 'Chưa có cuộc thảo luận nào hết!',
            'hidden' => 'Không có cuộc thảo luận nào tương ứng với bộ lọc đã chọn.',
        ],

        'message_hint' => [
            'in_general' => 'Bài đăng này sẽ vào phần thảo luận chung của beatmap, dùng mốc thởi gian để bắt đầu bài đăng (ví dụ 00:12:345) để mod beatmap này.',
            'in_timeline' => 'Để mod nhiều mốc thời gian , hãy đăng nhiều lần (một bài đăng trên một mốc thời gian).',
        ],

        'message_placeholder' => [
            'general' => 'Nhập vào đây để đăng vào Chung (:version)',
            'generalAll' => 'Nhập vào đây để đăng vào Chung (Tất cả difficulties)',
            'timeline' => 'Nhập vào đây để đăng vào Timeline (:version)',
        ],

        'message_type' => [
            'disqualify' => 'Disqualify',
            'hype' => 'Hype!',
            'mapper_note' => 'Ghi Chú',
            'nomination_reset' => 'Thiết Lập Lại Đề Cử',
            'praise' => 'Khen Ngợi',
            'problem' => 'Vấn Đề',
            'suggestion' => 'Đề Nghị',
        ],

        'mode' => [
            'events' => 'Lịch sử',
            'general' => 'Chung :scope',
            'timeline' => 'Timeline',
            'scopes' => [
                'general' => 'Difficulty này',
                'generalAll' => 'Tất cả difficulties',
            ],
        ],

        'new' => [
            'timestamp' => 'Mốc thời gian',
            'timestamp_missing' => 'ctrl-c trong chế độ chỉnh sửa (edit mode) và dán trong bài đăng của bạn để thêm một mốc thời gian!',
            'title' => 'Cuộc Thảo Luận Mới',
        ],

        'show' => [
            'title' => ':title được map bởi :mapper',
        ],

        'sort' => [
            '_' => 'Sắp xếp bởi:',
            'created_at' => 'thời gian tạo',
            'timeline' => 'mốc thời gian',
            'updated_at' => 'cập nhật gần đây',
        ],

        'stats' => [
            'deleted' => 'Đã xóa',
            'mapper_notes' => 'Ghi chú',
            'mine' => 'Của tôi',
            'pending' => 'Chưa giải quyết',
            'praises' => 'Khen ngợi',
            'resolved' => 'Đã giải quyết',
            'total' => 'Tất cả',
        ],

        'status-messages' => [
            'approved' => 'Beatmap này đã được chấp nhận (approved) vào :date!',
            'graveyard' => "Beatmap này chưa được cập nhật từ :date và có thể đã bị bỏ rơi bởi mapper...",
            'loved' => 'Beatmap này đã được love vào :date!',
            'ranked' => 'Beatmap này đã được xếp hạng (ranked) vào :date!',
            'wip' => 'Ghi chú: Beatmap này được đánh dấu là đang thực hiện bởi mapper.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button_done' => 'Đã Được Hype!',
        'confirm' => "Bạn chắc không? Việc này sẽ dùng một trong :n hype còn lại của bạn và không thể hủy bỏ.",
        'explanation' => 'Hype beatmap này để làm nó có khả năng được đề cử (nominate) và xếp hạng (rank)!',
        'explanation_guest' => 'Đăng nhập và hype beatmap này để nó có khả năng được đề cử (nominate) và xếp hạng (rank)!',
        'new_time' => "Bạn sẽ nhận được đợt hype khác vào :new_time.",
        'remaining' => 'Bạn còn :remaining hype.',
        'required_text' => 'Hype: :current/:required',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'feedback' => [
        'button' => 'Để Lại Phản Hồi',
    ],

    'nominations' => [
        'disqualification_prompt' => 'Lí do để qualify?',
        'disqualified_at' => 'Disqualified :time_ago (:reason).',
        'disqualified_no_reason' => 'không đưa ra lí do',
        'disqualify' => 'Disqualify',
        'incorrect_state' => 'Có lỗi khi thực hiện việc này, hãy thử tải lại trang.',
        'love' => 'Yêu thích',
        'love_confirm' => 'Yêu thích beatmap này?',
        'nominate' => 'Đề Cử',
        'nominate_confirm' => 'Đề cử (nominate) beatmap này?',
        'nominated_by' => 'Được :users đề cử',
        'qualified' => 'Dự tính sẽ xếp hạng (rank) vào :date, nếu không tìm thấy vấn đề gì.',
        'qualified_soon' => 'Dự tính sẽ sớm được xếp hạng (rank), nếu không tìm thấy vấn đề gì.',
        'required_text' => 'Trạng thái đề cử: :current/:required',
        'reset_message_deleted' => 'đã xóa',
        'title' => 'Trạng Thái Đề Cử',
        'unresolved_issues' => 'Vẫn còn một số vấn đề chưa giải quyết cần được xem lại trước.',

        'reset_at' => [
            'nomination_reset' => 'Quá trình đề cử (nomination) thiết lập lại vào :time_ago bởi :user với vấn đề mới :discussion (:message).',
            'disqualify' => 'Disqualified :time_ago bởi :user với vấn đề mới :discussion (:message).',
        ],

        'reset_confirm' => [
            'nomination_reset' => 'Bạn chắc không? Đăng một vấn đề mới sẽ thiết lập lại quá trình đề cử (nomination).',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => 'nhập từ khóa...',
            'login_required' => 'Đăng nhập để tìm kiếm.',
            'options' => 'Tùy Chọn Tìm Kiếm Khác',
            'supporter_filter' => 'Lọc theo :filters cần một supporter tag đang hoạt động',
            'not-found' => 'không có kết quả',
            'not-found-quote' => '... không, chả có gì cả.',
            'filters' => [
                'general' => 'Chung',
                'mode' => 'Chế Độ',
                'status' => 'Danh mục',
                'genre' => 'Thể Loại',
                'language' => 'Ngôn Ngữ',
                'extra' => 'thêm',
                'rank' => 'Thứ Hạng Đạt Được',
                'played' => 'Đã chơi',
            ],
            'sorting' => [
                'title' => 'tiêu đề',
                'artist' => 'nghệ sĩ',
                'difficulty' => 'độ khó',
                'updated' => 'ngày cập nhật',
                'ranked' => 'ngày xếp hạng',
                'rating' => 'đánh giá',
                'plays' => 'lượt chơi',
                'relevance' => 'độ liên quan',
                'nominations' => 'số đề cử',
            ],
            'supporter_filter_quote' => [
                '_' => 'Lọc theo :filters cần một :link đang hoạt động',
                'link_text' => 'osu!supporter tag',
            ],
        ],
    ],
    'general' => [
        'recommended' => 'Độ khó đề nghị',
        'converts' => 'Bao gồm beatmap được chuyển đổi',
    ],
    'mode' => [
        'any' => 'Bất Kì',
        'osu' => 'osu!',
        'taiko' => 'osu!taiko',
        'fruits' => 'osu!catch',
        'mania' => 'osu!mania',
    ],
    'status' => [
        'any' => 'Bất Kì',
        'ranked-approved' => 'Được Xếp Hạng & Được Chấp Nhận',
        'approved' => 'Được Chấp Nhận',
        'qualified' => 'Qualified',
        'loved' => 'Loved',
        'faves' => 'Yêu Thích',
        'pending' => 'Đang chờ & WIP',
        'graveyard' => 'Graveyard',
        'my-maps' => 'Map Của Tôi',
    ],
    'genre' => [
        'any' => 'Bất Kì',
        'unspecified' => 'Chưa Xác Định',
        'video-game' => 'Video Game',
        'anime' => 'Anime',
        'rock' => 'Rock',
        'pop' => 'Pop',
        'other' => 'Khác',
        'novelty' => 'Mới Lạ',
        'hip-hop' => 'Hip Hop',
        'electronic' => 'Điện Tử',
    ],
    'mods' => [
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        '9K' => '9K',
        'AP' => 'Auto Pilot',
        'DT' => 'Double Time',
        'EZ' => 'Easy Mode',
        'FI' => 'Fade In',
        'FL' => 'Flashlight',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'NF' => 'No Fail',
        'NM' => 'No mods',
        'PF' => 'Perfect',
        'Relax' => 'Relax',
        'SD' => 'Sudden Death',
        'SO' => 'Spun Out',
        'TD' => 'Touch Device',
    ],
    'language' => [
        'any' => 'Bất Kì',
        'english' => 'Tiếng Anh',
        'chinese' => 'Tiếng Trung',
        'french' => 'Tiếng Pháp',
        'german' => 'Tiếng Đức',
        'italian' => 'Tiếng Ý',
        'japanese' => 'Tiếng Nhật',
        'korean' => 'Tiếng Hàn',
        'spanish' => 'Tiếng Tây Ban Nha',
        'swedish' => 'Tiếng Thụy Điển',
        'instrumental' => 'Nhạc Cụ',
        'other' => 'Khác',
    ],
    'played' => [
        'any' => 'Bất Kì',
        'played' => 'Đã Chơi',
        'unplayed' => 'Chưa Chơi',
    ],
    'extra' => [
        'video' => 'Có Video',
        'storyboard' => 'Có Storyboard',
    ],
    'rank' => [
        'any' => 'Bất Kì',
        'XH' => 'Silver SS',
        'X' => 'SS',
        'SH' => 'Silver S',
        'S' => 'S',
        'A' => 'A',
        'B' => 'B',
        'C' => 'C',
        'D' => 'D',
    ],
];
