<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => 'Chủ Đề Đã Ghim',
    'slogan' => "chơi một mình khá rất nguy hiểm đấy.",
    'subforums' => 'Diễn đàn phụ',
    'title' => 'Diễn đàn ',

    'covers' => [
        'edit' => 'Chỉnh sửa bìa',

        'create' => [
            '_' => 'Đặt ảnh bìa',
            'button' => 'Tải lên ảnh',
            'info' => 'Kích cỡ ảnh bìa nên ở :dimensions. Bạn cũng có thể kéo ảnh vào đây để tải lên.',
        ],

        'destroy' => [
            '_' => 'Gỡ bỏ ảnh bìa',
            'confirm' => 'Bạn có chắc mình muốn gỡ bỏ ảnh bìa?',
        ],
    ],

    'forums' => [
        'latest_post' => 'Bài viết mới nhất',

        'index' => [
            'title' => 'Diễn đàn Index',
        ],

        'topics' => [
            'empty' => 'Không có chủ đề nào cả!',
        ],
    ],

    'mark_as_read' => [
        'forum' => 'Đánh dấu diễn đàn đã đọc',
        'forums' => 'Đánh dấu diễn đàn đã đọc',
        'busy' => 'Đang đánh dấu đã đọc...',
    ],

    'post' => [
        'confirm_destroy' => 'Bạn muốn xóa bài viết?',
        'confirm_restore' => 'Bạn muốn phục hồi bài viết?',
        'edited' => 'Lần chỉnh sửa cuối cùng bởi :user :when, chỉnh sửa :count_delimited tổng thời gian.|Lần chỉnh sửa cuối cùng bởi :user :when, chỉnh sửa :count_delimited tổng thời gian.',
        'posted_at' => 'đã đăng vào :when',
        'posted_by' => 'đã đăng bởi :username',

        'actions' => [
            'destroy' => 'Xóa bài viết',
            'edit' => 'Chỉnh sửa bài viết',
            'report' => 'Báo cáo bài đăng',
            'restore' => 'Phục hồi bài viết',
        ],

        'create' => [
            'title' => [
                'reply' => 'Có trả lời mới',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited bài đăng|:count_delimited bài đăng',
            'topic_starter' => 'Người tạo topic',
        ],
    ],

    'search' => [
        'go_to_post' => 'Đi đến bài viết',
        'post_number_input' => 'nhập số bài viết',
        'total_posts' => ':posts_count tổng bài viết',
    ],

    'topic' => [
        'confirm_destroy' => 'Bạn có muốn xóa bài viết này?',
        'confirm_restore' => 'Bạn có muốn phục hồi bài viết này?',
        'deleted' => 'chủ đề đã xóa',
        'go_to_latest' => 'xem bài viết mới nhất',
        'has_replied' => 'Bạn đã trả lời topic này',
        'in_forum' => 'trong :forum',
        'latest_post' => ':when bởi :user',
        'latest_reply_by' => 'trả lời cuối bởi :user',
        'new_topic' => 'Đăng một chủ đề mới',
        'new_topic_login' => 'Đăng nhập để đăng một chủ đề mới',
        'post_reply' => 'Đăng',
        'reply_box_placeholder' => 'Nhập vào đây để trả lời',
        'reply_title_prefix' => 'Re',
        'started_by' => 'bởi :user',
        'started_by_verbose' => 'bắt đầu bởi :user',

        'actions' => [
            'destroy' => 'Xóa bài viết',
            'restore' => 'Phục hồi bài viết',
        ],

        'create' => [
            'close' => 'Đóng',
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

        'logs' => [
            '_' => '',
            'button' => '',

            'columns' => [
                'action' => 'Hành động',
                'date' => 'Ngày',
                'user' => 'Người dùng',
            ],

            'data' => [
                'add_tag' => 'đã thêm nhãn ":tag"',
                'announcement' => '',
                'edit_topic' => '',
                'fork' => '',
                'pin' => '',
                'post_operation' => '',
                'remove_tag' => '',
                'source_forum_operation' => '',
                'unpin' => '',
            ],

            'no_results' => '',

            'operations' => [
                'delete_post' => '',
                'delete_topic' => '',
                'edit_topic' => '',
                'edit_poll' => '',
                'fork' => '',
                'issue_tag' => '',
                'lock' => '',
                'merge' => '',
                'move' => '',
                'pin' => '',
                'post_edited' => '',
                'restore_post' => '',
                'restore_topic' => '',
                'split_destination' => '',
                'split_source' => '',
                'topic_type' => '',
                'topic_type_changed' => '',
                'unlock' => '',
                'unpin' => '',
                'user_lock' => '',
                'user_unlock' => '',
            ],
        ],

        'post_edit' => [
            'cancel' => 'Hủy',
            'post' => 'Lưu',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => 'diễn đàn đã đăng kí',

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

            'preview' => 'Xem Lại Bài Đăng',

            'create_poll_button' => [
                'add' => 'Tạo một cuộc thăm dò',
                'remove' => 'Hủy bỏ',
            ],

            'poll' => [
                'hide_results' => 'Ẩn kết quả cuộc thăm dò.',
                'hide_results_info' => 'Nó sẽ chỉ được hiển thị sau khi cuộc thăm dò kết thúc.',
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
            'feature_votes' => 'ưu tiên sao',
            'replies' => 'câu trả lời',
            'views' => 'lượt xem',
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
            'to_0_confirm' => 'Mở khóa chủ đề?',
            'to_0_done' => 'Đã mở khóa chủ đề',
            'to_1' => 'Khóa chủ đề',
            'to_1_confirm' => 'Khóa chủ đề?',
            'to_1_done' => 'Chủ đề đã bị khóa',
        ],

        'moderate_move' => [
            'title' => 'Chuyển sang diễn đàn khác',
        ],

        'moderate_pin' => [
            'to_0' => 'Bỏ ghim chủ đề',
            'to_0_confirm' => 'Bỏ ghim chủ đề?',
            'to_0_done' => 'Chủ đề đã được bỏ ghim',
            'to_1' => 'Ghim chủ đề',
            'to_1_confirm' => 'Ghim chủ đề?',
            'to_1_done' => 'Chủ để đã ghim',
            'to_2' => 'Ghim chủ đề và đánh dấu là thông báo',
            'to_2_confirm' => 'Ghim chủ đề và đánh dấu là thông báo?',
            'to_2_done' => 'Chủ đề đã ghim và sẽ đánh dấu là thông báo',
        ],

        'moderate_toggle_deleted' => [
            'show' => 'Hiển thị các bài đăng bị xóa',
            'hide' => 'Ẩn các bài viết bị xóa',
        ],

        'show' => [
            'deleted-posts' => 'Bài Đăng Đã Bị Xóa',
            'total_posts' => 'Tổng Bài Đăng',

            'feature_vote' => [
                'current' => 'Độ Ưu Tiên: +:count',
                'do' => 'Thúc đẩy yêu cầu này',

                'info' => [
                    '_' => 'Đây là một :feature_request. Yêu cầu tính năng có thể được bỏ phiếu bởi :supporters.',
                    'feature_request' => 'yêu cầu tính năng',
                    'supporters' => 'người hỗ trợ',
                ],

                'user' => [
                    'count' => '{0} không có bình chọn|[1,*] :count phiếu',
                    'current' => 'Bạn còn :votes.',
                    'not_enough' => "Bạn không còn lượt bình chọn nào hết",
                ],
            ],

            'poll' => [
                'edit' => 'Chỉnh sửa cuộc thăm dò ý kiến',
                'edit_warning' => 'Chỉnh sửa cuộc thăm dò sẽ xóa bỏ các kết quả hiện tại!',
                'vote' => 'Bỏ phiếu',

                'button' => [
                    'change_vote' => 'Thay đổi bình chọn',
                    'edit' => 'Sửa cuộc thăm dò',
                    'view_results' => 'Bỏ qua đến phần kết quả',
                    'vote' => 'Bỏ phiếu',
                ],

                'detail' => [
                    'end_time' => 'Cuộc thăm dò sẽ kết thúc vào :time',
                    'ended' => 'Cuộc thăm dò đã kết thúc vào :time',
                    'results_hidden' => 'Kết quả sẽ được hiển thị sau khi cuộc thăm dò kết thúc.',
                    'total' => 'Tổng số phiếu: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => 'Chưa đánh dấu',
            'to_watching' => 'Đánh dấu',
            'to_watching_mail' => 'Đánh dấu với thông báo',
            'tooltip_mail_disable' => 'Đã bật thông báo. Nhấp để tắt',
            'tooltip_mail_enable' => 'Đã tắt thông báo. Nhấp để bật',
        ],
    ],
];
