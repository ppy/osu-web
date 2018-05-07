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
    'slogan' => 'Chơi một mình khá là nguy hiểm đấy.',
    'subforums' => 'Subforums',
    'title' => 'Cộng Đồng osu!',

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
        'edited' => 'Chỉnh sửa lần cuối bởi :user vào :when, đã chỉnh sửa tổng cộng :count lần.',
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
        'post_reply' => 'Đăng',
        'reply_box_placeholder' => 'Nhập vào đây để trả lời',
        'started_by' => 'bởi :user',

        'create' => [
            'preview' => 'Xem trước',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => 'Viết',
            'submit' => 'Đăng',

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
                'length_days_prefix' => '',
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
            'action-0' => 'Loại bỏ tag "added"',
            'action-1' => 'Thêm tag "added"',
            'state-0' => 'Đã loại bỏ tag "added"',
            'state-1' => 'Đã thêm tag "added"',
        ],

        'issue_tag_assigned' => [
            'action-0' => 'Loại bỏ tag "assigned"',
            'action-1' => 'Thêm tag "assigned"',
            'state-0' => 'Đã loại bỏ tag "assigned"',
            'state-1' => 'Đã thêm tag "assigned"',
        ],

        'issue_tag_confirmed' => [
            'action-0' => 'Loại bỏ tag "confirmed"',
            'action-1' => 'Thêm tag "confirmed"',
            'state-0' => 'Đã loại bỏ tag "confirmed"',
            'state-1' => 'Đã thêm tag "confirmed"',
        ],

        'issue_tag_duplicate' => [
            'action-0' => 'Loại bỏ tag "duplicate"',
            'action-1' => 'Thêm tag "duplicate"',
            'state-0' => 'Đã loại bỏ tag "duplicate"',
            'state-1' => 'Đã thêm tag "duplicate"',
        ],

        'issue_tag_invalid' => [
            'action-0' => 'Loại bỏ tag "invalid"',
            'action-1' => 'Thêm tag "invalid"',
            'state-0' => 'Đã loại bỏ tag "invalid"',
            'state-1' => 'Đã thêm tag "invalid"',
        ],

        'issue_tag_resolved' => [
            'action-0' => 'Loại bỏ tag "resolved"',
            'action-1' => 'Thêm tag "resolved"',
            'state-0' => 'Đã loại bỏ tag "resolved"',
            'state-1' => 'Đã thêm tag "resolved"',
        ],

        'lock' => [
            'is_locked' => 'Chủ đề này đã bị khóa và không thể trả lời',
            'lock-0' => 'Mở khóa chủ đề',
            'lock-1' => 'Khóa chủ đề',
            'state-0' => 'Đã mở khóa chủ đề',
            'state-1' => 'Đã khóa chủ đề',
        ],

        'moderate_move' => [
            'title' => 'Chuyển sang diễn đàn khác',
        ],

        'moderate_pin' => [
            'pin-0' => 'Bỏ ghim chủ đề',
            'pin-1' => 'Ghim chủ đề',
            'pin-2' => 'Ghim chủ đề và đánh dấu là thông báo',
            'state-0' => 'Đã bỏ ghim chủ đề',
            'state-1' => 'Đã ghim chủ đề',
            'state-2' => 'Đã ghim và đánh dấu chủ đề là thông báo',
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
                    'not_enough' => 'Bạn không còn lượt bình chọn nào hết',
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
            'state-0' => 'Đã hủy đăng kí chủ đề',
            'state-1' => 'Đã đăng khỉ chủ đề',
            'watch-0' => 'Hủy đăng kí chủ đề',
            'watch-1' => 'Đăng kí chủ đề',
        ],
    ],
];
