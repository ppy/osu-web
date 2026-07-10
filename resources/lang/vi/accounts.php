<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => 'cài đặt tài khoản',
        'username' => 'tên người dùng',

        'avatar' => [
            'title' => 'Ảnh đại diện',
            'reset' => 'đặt lại',
            'rules' => 'Hãy chắc rằng ảnh đại diện của bạn tuân thủ :link.<br/>Điều này có nghĩa rằng ảnh phải <strong>phù hợp với mọi lứa tuổi</strong>. Ví dụ như không có nội dung khiêu gợi, thô tục hoặc gợi tưởng.',
            'rules_link' => 'những cân nhắc về Nội dung trực quan',
        ],

        'email' => [
            'new' => 'email mới',
            'new_confirmation' => 'xác nhận email',
            'title' => 'Email',
            'locked' => [
                '_' => 'Vui lòng liên hệ :accounts nếu bạn cần cập nhật địa chỉ email.',
                'accounts' => 'đội ngũ hỗ trợ tài khoản',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'API cũ',
        ],

        'password' => [
            'current' => 'mật khẩu hiện tại',
            'new' => 'mật khẩu mới',
            'new_confirmation' => 'xác nhận mật khẩu',
            'title' => 'Mật khẩu',
        ],

        'profile' => [
            'country' => 'quốc gia',
            'title' => 'Trang cá nhân',

            'country_change' => [
                '_' => "Có vẻ như quốc gia cho tài khoản của bạn chưa khớp với quốc gia bạn đang ở. :update_link.",
                'update_link' => 'Cập nhật quốc gia thành :country',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => 'vị trí hiện tại',
                'user_interests' => 'sở thích',
                'user_occ' => 'nghề nghiệp',
                'user_twitter' => '',
                'user_website' => 'trang web',
            ],
        ],

        'signature' => [
            'title' => 'Chữ kí',
            'update' => 'cập nhật',
        ],
    ],

    'github_user' => [
        'info' => "Nếu bạn là người đóng góp cho kho lưu trữ nguồn mở của osu!, việc liên kết tài khoản GitHub của bạn tại đây sẽ liên kết các mục nhật ký thay đổi với trang cá nhân osu! của bạn. Tài khoản GitHub không có lịch sử đóng góp cho osu! không thể liên kết được.",
        'link' => 'Liên kết tài khoản GitHub',
        'title' => 'GitHub',
        'unlink' => 'Hủy liên kết tài khoản GitHub',

        'error' => [
            'already_linked' => 'Tài khoản GitHub này đã được liên kết với một người dùng khác.',
            'no_contribution' => 'Không thể liên kết tài khoản GitHub mà không có bất kỳ lịch sử đóng góp nào trong kho lưu trữ của osu!.',
            'unverified_email' => 'Vui lòng xác minh email chính của bạn trên GitHub, sau đó thử liên kết lại tài khoản của bạn.',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_reply' => '',
        'beatmapset_discussion_qualified_problem' => 'nhận thông báo về vấn đề mới ở các beatmap đủ tiêu chuẩn của chế độ này',
        'beatmapset_disqualify' => 'nhận thông báo khi beatmap ở các chế độ sau bị từ chối',
        'comment_reply' => 'nhận thông báo khi có phản hồi đến bình luận của bạn',
        'news_post' => 'nhận thông báo về các bài đăng tin tức',
        'title' => 'Thông báo',
        'topic_auto_subscribe' => 'tự động nhận thông báo cho các chủ đề mới trên diễn đàn mà bạn tạo hoặc trả lời',

        'options' => [
            '_' => 'cách nhận thông báo',
            'beatmap_owner_change' => 'độ khó khách mời',
            'beatmapset:modding' => 'sửa đổi beatmap',
            'channel_mention' => 'nhắc tên trong chat',
            'channel_message' => 'tin nhắn riêng tư',
            'channel_team' => 'tin nhắn đội',
            'comment_new' => 'bình luận mới',
            'forum_topic_reply' => 'trả lời chủ đề',
            'mail' => 'thư',
            'mapping' => 'người tạo beatmap',
            'news_post' => 'bài đăng tin tức',
            'push' => 'đẩy',
        ],

        'tooltips' => [
            'beatmap_owner_change' => 'khi bạn được thêm làm guest mapper cho một độ khó của bài nhạc',
            'beatmapset:modding' => 'khi các thảo luận beatmap bạn đang theo dõi có cập nhật, hoặc có lỗi hoặc góp ý xuất hiện trên beatmap của chính bạn.',
            'channel_mention' => 'khi bạn được nhắc đến trong một kênh trò chuyện công khai',
            'channel_message' => 'khi bạn nhận được tin nhắn riêng tư',
            'channel_team' => 'khi kênh chat đội của bạn có tin nhắn mới',
            'comment_new' => 'khi có bình luận mới về một mục bạn đang theo dõi',
            'forum_topic_reply' => 'khi các chủ đề diễn đàn bạn đang theo dõi có phản hồi mới',
            'mapping' => 'khi một mapper bạn đang theo dõi tải lên một beatmap',
            'news_post' => 'khi có bài viết tin tức mới',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'client được cấp quyền',
        'own_clients' => 'client đã có',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_anime_cover' => 'hiện ảnh bìa beatmap phong cách anime',
        'beatmapset_show_nsfw' => 'ẩn cảnh báo nội dung không lành mạnh trong beatmap',
        'beatmapset_title_show_original' => 'hiển thị metadata của beatmap bằng ngôn ngữ gốc',
        'title' => 'Tuỳ chọn',

        'beatmapset_download' => [
            '_' => 'kiểu tải beatmap mặc định',
            'all' => 'kèm video nếu có',
            'direct' => 'mở trong osu!direct',
            'no_video' => 'không kèm video',
        ],
    ],

    'playstyles' => [
        'default_ruleset' => '',
        'keyboard' => 'bàn phím',
        'mouse' => 'chuột',
        'tablet' => 'bảng vẽ',
        'title' => 'Lối Chơi',
        'touch' => 'cảm ứng',
    ],

    'privacy' => [
        'friends_only' => 'chặn tin nhắn từ những người không có trong danh sách bạn bè của bạn',
        'hide_online' => 'ẩn trạng thái trực tuyến của bạn',
        'hide_online_info' => 'tính năng này tương ứng với chế độ "xuất hiện ngoại tuyến" trong osu!lazer',
        'title' => 'Quyền Riêng Tư',
    ],

    'security' => [
        'current_session' => 'hiện tại',
        'end_session' => 'Kết thúc Phiên',
        'end_session_confirmation' => 'Việc này sẽ ngay lập tức kết thúc phiên của bạn trên thiết bị đó. Bạn chắc chứ?',
        'last_active' => 'Hoạt động lần cuối:',
        'title' => 'Bảo mật',
        'web_sessions' => 'phiên trên web',
    ],

    'update_email' => [
        'update' => 'cập nhật',
    ],

    'update_password' => [
        'update' => 'cập nhật',
    ],

    'user_totp' => [
        'title' => 'Ứng Dụng Xác Thực',
        'usage_note' => 'Xác thực bằng ứng dụng xác thực thay cho email. Email vẫn sẽ được sử dụng như một phương thức dự phòng.',

        'button' => [
            'remove' => 'Loại bỏ',
            'setup' => 'Thêm ứng dụng xác thực',
        ],
        'status' => [
            'label' => 'trạng thái',
            'not_set' => 'Chưa được thiết lập',
            'set' => 'Đã thiết lập',
        ],
    ],

    'verification_completed' => [
        'text' => 'Bây giờ bạn có thể đóng cửa sổ này',
        'title' => 'Quá trình xác minh đã hoàn tất',
    ],

    'verification_invalid' => [
        'title' => 'Đường dẫn xác minh không hợp lệ hoặc đã hết hạn',
    ],
];
