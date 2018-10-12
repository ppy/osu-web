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
    'pinned_topics' => 'Chủ Đề Đã Ghim',
    'slogan' => "Chơi một mình khá là nguy hiểm đấy.",
    'subforums' => 'Subforums',
    'title' => 'diễn đàn osu!',

    'covers' => [
        'create' => [
            '_' => 'Đặt ảnh bìa',
            'button' => 'Tải lên ảnh',
            'info' => 'Kích cỡ ảnh bìa nên ở :dimensions. Bạn cũng có thể kéo ảnh vào đây để tải lên.',
        ],

        'destroy' => [
            '_' => 'Gỡ bỏ ảnh bìa',
            'confirm' => 'Bạn chắc là mình muốn gỡ bỏ ảnh bìa?',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] Có trả lời mới cho chủ đề ":title"',
    ],

    'forums' => [
        'topics' => [
            'empty' => 'Không có chủ đề nào cả!',
        ],
    ],

    'post' => [
        'confirm_destroy' => 'Bạn muốn xóa bài viết?',
        'confirm_restore' => 'Bạn muốn phục hồi bài viết?',
        'edited' => 'Chỉnh sửa lần cuối bởi :user :when, đã chỉnh sửa tổng cộng :count lần.',
        'posted_at' => 'đăng vào :when',

        'actions' => [
            'destroy' => 'Xóa bài viết',
            'restore' => 'Phục hồi bài viết',
            'edit' => 'Chỉnh sửa bài viết',
        ],
    ],

    'search' => [
        'go_to_post' => 'Đi đến bài viết',
        'post_number_input' => 'nhập số thứ tự',
        'total_posts' => 'tổng cộng :posts_count bài viết',
    ],

    'topic' => [
        'deleted' => 'chủ đề đã xóa',
        'go_to_latest' => 'xem bài viết mới nhất',
        'latest_post' => ':when bởi :user',
        'latest_reply_by' => 'trả lời cuối bởi :user',
        'new_topic' => 'Đăng một chủ đề mới',
        'new_topic_login' => 'Đăng nhập để đăng một chủ đề mới',
        'post_reply' => 'Đăng',
        'reply_box_placeholder' => 'Nhập vào đây để trả lời',
        'reply_title_prefix' => 'Re',
        'started_by' => 'bởi :user',
        'started_by_verbose' => 'bắt đầu bởi :user',

        'create' => [
            'preview' => 'Xem trước',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Viết',
            'submit' => 'Đăng',

            'necropost' => [
                'default' => 'Chủ đề này đã không còn hoạt động trong một thời gian. Chỉ đăng ở đây nếu bạn có một lý do cụ thể.',

                'new_topic' => [
                    '_' => "Chủ đề này đã không còn hoạt động trong một thời gian. Nếu bạn không có một lý do cụ thể để đăng ở đây, vui lòng :create.",
                    'create' => 'tạo một chủ đề mới',
                ],
            ],

            'placeholder' => [
                'body' => 'Nhập nội dung bài viết vào đây',
                'title' => 'Click vào đây để nhập tiêu đề',
            ],
        ],

        'jump' => [
            'enter' => 'click để nhập số thứ tự cụ thể',
            'first' => 'đi đến bài đăng đầu tiên',
            'last' => 'đi đến bài đăng cuối cùng',
            'next' => 'bỏ qua 10 bài đăng',
            'previous' => 'trở lại 10 bài đăng',
        ],

        'post_edit' => [
            'cancel' => 'Hủy',
            'post' => 'Lưu',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title' => 'Diễn Đàn Đã Đăng Kí',
            'title_compact' => 'diễn đàn đã đăng kí',
            'title_main' => 'Diễn Đàn đã <strong>Đăng Kí</strong>',

            'box' => [
                'total' => 'Chủ đề đã đăng kí',
                'unread' => 'Chủ đề có trả lời mới',
            ],

            'info' => [
                'total' => 'Bạn đã đăng kí :total chủ đề.',
                'unread' => 'Bạn chưa đọc :unread trả lời của những chủ đề đã đăng kí.',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => 'Hủy đăng kí chủ đề?',
                'title' => 'Hủy đăng kí',
            ],
        ],
    ],

    'topics' => [
        '_' => 'Chủ đề',

        'actions' => [
            'login_reply' => 'Đăng nhập để Trả lời',
            'reply' => 'Trả lời',
            'reply_with_quote' => 'Trích dẫn bài viết để trả lời',
            'search' => 'Tìm kiếm',
        ],

        'create' => [
            'create_poll' => 'Tạo Thăm Dò Ý Kiến',

            'create_poll_button' => [
                'add' => 'Tạo một cuộc thăm dò',
                'remove' => 'Hủy bỏ',
            ],

            'poll' => [
                'length' => 'Thời gian thăm dò',
                'length_days_suffix' => 'ngày',
                'length_info' => 'Để trống nếu nó không bao giờ kết thúc',
                'max_options' => 'Số lựa chọn cho một người',
                'max_options_info' => 'Đây là số lượng các lựa chọn mà người dùng được chọn trong khi thăm dò.',
                'options' => 'Các lựa chọn',
                'options_info' => 'Đặt mỗi lựa chọn trên một dòng. Bạn có thể nhập tối đa 10 lựa chọn.',
                'title' => 'Câu hỏi',
                'vote_change' => 'Cho phép bỏ phiếu lại.',
                'vote_change_info' => 'Nếu được cho phép, người dùng có thể đổi phiếu của họ.',
            ],
        ],

        'edit_title' => [
            'start' => 'Chỉnh sửa tiêu đề',
        ],

        'index' => [
            'views' => 'lượt xem',
            'replies' => 'câu trả lời',
        ],

        'issue_tag_added' => [
            'to_0' => 'Loại bỏ tag "added"',
            'to_0_done' => 'Đã loại bỏ tag "added"',
            'to_1' => 'Thêm tag "added"',
            'to_1_done' => 'Đã thêm tag "added"',
        ],

        'issue_tag_assigned' => [
            'to_0' => 'Loại bỏ tag "assigned"',
            'to_0_done' => 'Đã loại bỏ tag "assigned',
            'to_1' => 'Thêm tag "assigned"',
            'to_1_done' => 'Đã thêm tag "assigned"',
        ],

        'issue_tag_confirmed' => [
            'to_0' => 'Loại bỏ tag "confirmed"',
            'to_0_done' => 'Đã loại bỏ tag "confirmed"',
            'to_1' => 'Thêm tag "confirmed"',
            'to_1_done' => 'Đã thêm tag "confirmed"',
        ],

        'issue_tag_duplicate' => [
            'to_0' => 'Loại bỏ tag "duplicate"',
            'to_0_done' => 'Đã loại bỏ tag "duplicate"',
            'to_1' => 'Thêm tag "duplicate"',
            'to_1_done' => 'Đã thêm tag "duplicate"',
        ],

        'issue_tag_invalid' => [
            'to_0' => 'Loại bỏ tag "invalid"',
            'to_0_done' => 'Đã loại bỏ tag "invalid"',
            'to_1' => 'Thêm tag "invalid"',
            'to_1_done' => 'Đã thêm tag "invalid"',
        ],

        'issue_tag_resolved' => [
            'to_0' => 'Loại bỏ tag "resolved"',
            'to_0_done' => 'Đã loại bỏ tag "resolved"',
            'to_1' => 'Thêm tag "resolved"',
            'to_1_done' => 'Đã thêm tag "resolved"',
        ],

        'lock' => [
            'is_locked' => 'Chủ đề này đã bị khóa và không thể trả lời',
            'to_0' => 'Mở khóa chủ đề',
            'to_0_done' => 'Đã mở khóa chủ đề',
            'to_1' => 'Khóa chủ đề',
            'to_1_done' => 'Chủ đề đã bị khóa',
        ],

        'moderate_move' => [
            'title' => 'Chuyển sang diễn đàn khác',
        ],

        'moderate_pin' => [
            'to_0' => 'Bỏ ghim chủ đề',
            'to_0_done' => 'Chủ đề đã được bỏ ghim',
            'to_1' => 'Ghim chủ đề',
            'to_1_done' => 'Chủ để đã ghim',
            'to_2' => 'Ghim chủ đề và đánh dấu là thông báo',
            'to_2_done' => 'Chủ đề đã ghim và sẽ đánh dấu là thông báo',
        ],

        'show' => [
            'deleted-posts' => 'Bài Đăng Đã Bị Xóa',
            'total_posts' => 'Tổng Bài Đăng',

            'feature_vote' => [
                'current' => 'Độ Ưu Tiên: +:count',
                'do' => 'Thúc đẩy yêu cầu này',

                'user' => [
                    'count' => '{0} không có bình chọn|[1,*] :count phiếu',
                    'current' => 'Bạn còn :votes.',
                    'not_enough' => "Bạn không còn lượt bình chọn nào hết",
                ],
            ],

            'poll' => [
                'vote' => 'Bỏ phiếu',

                'detail' => [
                    'end_time' => 'Cuộc thăm dò sẽ kết thúc vào :time',
                    'ended' => 'Cuộc thăm dò đã kết thúc vào :time',
                    'total' => 'Tổng số phiếu: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Chưa đánh dấu',
            'to_watching' => 'Đánh dấu',
            'to_watching_mail' => 'Đánh dấu với thông báo',
            'mail_disable' => 'Tắt thông báo',
        ],
    ],
];
