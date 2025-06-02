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
            'rules_link' => 'những tiêu chuẩn cộng đồng',
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
        'beatmapset_discussion_qualified_problem' => 'nhận thông báo về vấn đề mới ở các beatmap đủ tiêu chuẩn của chế độ này',
        'beatmapset_disqualify' => 'nhận thông báo khi beatmap ở các chế độ sau bị từ chối',
        'comment_reply' => 'nhận thông báo khi có phản hồi đến bình luận của bạn',
        'title' => 'Thông báo',
        'topic_auto_subscribe' => 'tự động nhận thông báo cho các chủ đề bạn tạo trong forum',

        'options' => [
            '_' => 'phương thức giao hàng',
            'beatmap_owner_change' => 'độ khó khách mời',
            'beatmapset:modding' => 'sửa đổi beatmap',
            'channel_message' => 'tin nhắn riêng tư',
            'channel_team' => '',
            'comment_new' => 'bình luận mới',
            'forum_topic_reply' => 'trả lời chủ đề',
            'mail' => 'thư',
            'mapping' => 'người tạo beatmap',
            'push' => 'đẩy',
        ],
    ],

    'oauth' => [
        'authorized_clients' => 'client được cấp quyền',
        'own_clients' => 'client đã có',
        'title' => 'OAuth',
    ],

    'options' => [
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
        'keyboard' => 'bàn phím',
        'mouse' => 'chuột',
        'tablet' => 'bảng vẽ',
        'title' => 'Lối Chơi',
        'touch' => 'cảm ứng',
    ],

    'privacy' => [
        'friends_only' => 'chặn tin nhắn từ những người không có trong danh sách bạn bè của bạn',
        'hide_online' => 'ẩn trạng thái của bạn khi bạn online',
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

    'verification_completed' => [
        'text' => 'Bây giờ bạn có thể đóng cửa sổ này',
        'title' => 'Tài khoản đã được xác minh',
    ],

    'verification_invalid' => [
        'title' => 'Đường dẫn xác minh tài khoản không hợp lệ hoặc hết hạn',
    ],
];
