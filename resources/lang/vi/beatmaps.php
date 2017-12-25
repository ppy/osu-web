<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
            'error' => 'Không thể cập nhật vote',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => 'cho phép kudosu',
        'delete' => 'xóa',
        'deleted' => 'Đã xóa bởi :editor :delete_time.',
        'deny_kudosu' => 'từ chối kudosu',
        'edit' => 'sửa',
        'edited' => 'Sửa đổi cuối cùng bởi :editor :update_time.',
        'kudosu_denied' => 'Đã từ chối nhận kudosu.',
        'message_placeholder' => 'Nhập vào đây để đăng',
        'message_type_select' => 'Chọn Loại Nhận Xét',
        'reply_notice' => 'Bấm enter để trả lời.',
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

        'message_type' => [
            'hype' => 'Hype!',
            'mapper_note' => 'Ghi chú',
            'praise' => 'Khen',
            'problem' => 'Vấn đề',
            'suggestion' => 'Đề nghị',
        ],

        'mode' => [
            'events' => 'Lịch sử',
            'general' => 'Chung',
            'general_all' => 'Chung (tất cả difficulties)',
            'timeline' => 'Timeline',
        ],

        'new' => [
            'timestamp' => 'Mốc thời gian',
            'timestamp_missing' => 'ctrl-c trong chế độ chỉnh sửa (edit mode) và dán trong bài đăng của bạn để thêm một mốc thời gian!',
            'title' => 'Cuộc Thảo Luận Mới',
        ],

        'show' => [
            'title' => ':title được map bởi :mapper',
        ],

        'stats' => [
            'deleted' => 'Đã xóa',
            'mapper_notes' => 'Ghi chú',
            'mine' => 'Của tôi',
            'pending' => 'Chưa giải quyết',
            'praises' => 'Khen',
            'resolved' => 'Đã giải quyết',
            'total' => 'Tất cả',
        ],

        'status-messages' => [
            'approved' => 'Beatmap này đã được approve vào :date!',
            'graveyard' => 'Beatmap này chưa được update từ :date và có thể đã bị bỏ rơi bởi mapper...',
            'loved' => 'Beatmap này đã được love vào :date!',
            'ranked' => 'Beatmap này đã được rank vào :date!',
            'wip' => 'Ghi chú: Beatmap này được đánh dấu là đang thực hiện bởi mapper.',
        ],

    ],

    'hype' => [
        'button' => 'Hype Beatmap!',
        'button-done' => 'Đã Được Hype!',
        'confirm' => 'Bạn chắc không? Việc này sẽ dùng một trong :n hype còn lại của bạn bà không thể hủy bỏ.',
        'explanation' => 'Hype beatmap này để làm nó có khả năng được nominate và rank!',
        'explanation_guest' => 'Đăng nhập hype beatmap này để nó có khả năng được nominate và rank!',
        'new_time' => 'Bạn sẽ nhận được đợt hype khác vào :new_time.',
        'remaining' => 'Bạn còn :remaining hype.',
        'section_title' => 'Hype Train',
        'title' => 'Hype',
    ],

    'nominations' => [
        'disqualifed-at' => 'Bị disqualify :time_ago (:reason).',
        'disqualifed_no_reason' => 'không đưa ra lí do',
        'disqualification-prompt' => 'Lí do để qualify?',
        'disqualify' => 'Disqualify',
        'incorrect-state' => 'Có lỗi khi thực hiện việc đó, hãy thử tải lại trang.',
        'nominate' => 'Nominate',
        'nominated-by' => 'được nomimate bởi :users',
        'nominate-confirm' => 'Nominate beatmap này?',
        'qualified' => 'Dự tính sẽ rank vào :date, nếu không tìm thấy vấn đề gì.',
        'qualified-soon' => 'Dự tính sẽ sớm được rank, nếu không tìm thấy vấn đề gì.',
        'reset-confirm' => 'Bạn chắc không? Đăng một vấn đề mới sẽ thiết lập lại nomination.',
        'required-text' => 'Nominations: :current/:required',
        'title' => 'Trạng Thái Nominate',
    ],

    'listing' => [
        'search' => [
            'prompt' => 'nhập từ khóa...',
            'options' => 'Tùy Chọn Tìm Kiếm Khác',
            'not-found' => 'không có kết quả',
            'not-found-quote' => '... không, chả có gì cả.',
            'filters' => [
                'mode' => 'Chế Độ',
                'status' => 'Trạng Thái Rank',
                'genre' => 'Thể Loại',
                'language' => 'Ngôn Ngữ',
                'extra' => 'thêm',
                'rank' => 'Thứ Hạng',
            ],
        ],
        'mode' => 'Chế Độ',
        'status' => 'Trạng Thái Rank',
        'mapped-by' => 'được map bởi :mapper',
        'source' => 'từ :source',
        'load-more' => 'Tải thêm...',
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
        'ranked-approved' => 'Được Rank & Approve',
        'approved' => 'Được Approve',
        'qualified' => 'Được Qualify',
        'loved' => 'Được Love',
        'faves' => 'Yêu Thích',
        'pending' => 'Pending',
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
        'NF' => 'No Fail',
        'EZ' => 'Easy',
        'HD' => 'Hidden',
        'HR' => 'Hard Rock',
        'SD' => 'Sudden Death',
        'DT' => 'Double Time',
        'Relax' => 'Relax',
        'HT' => 'Half Time',
        'NC' => 'Nightcore',
        'FL' => 'Flashlight',
        'SO' => 'Spun Out',
        'AP' => 'Auto Pilot',
        'PF' => 'Perfect',
        '4K' => '4K',
        '5K' => '5K',
        '6K' => '6K',
        '7K' => '7K',
        '8K' => '8K',
        'FI' => 'Fade In',
        '9K' => '9K',
        'NM' => 'No mods',
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
