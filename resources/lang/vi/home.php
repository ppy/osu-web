<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'landing' => [
        'download' => 'Tải ngay',
        'online' => '<strong>:players</strong> đang chơi trong <strong>:games</strong> games',
        'peak' => 'Đỉnh điểm, :count người chơi online',
        'players' => '<strong>:count</strong> người chơi đã đăng kí',
        'title' => 'chào mừng',
        'see_more_news' => 'xem các bản tin khác',

        'slogan' => [
            'main' => 'game nhịp điệu free-to-win hay nhất',
            'sub' => 'chỉ bắt đầu bằng một cái click chuột',
        ],
    ],

    'search' => [
        'advanced_link' => 'Tìm kiếm nâng cao',
        'button' => 'Tìm kiếm ',
        'empty_result' => 'Không có kết quả!',
        'keyword_required' => 'Cần ít nhất một từ khóa tìm kiếm',
        'placeholder' => 'nhập để tìm kiếm',
        'title' => 'Tìm Kiếm',

        'beatmapset' => [
            'login_required' => 'Đăng nhập để tìm beatmap',
            'more' => 'còn :count kết quả tìm kiếm beatmap khác',
            'more_simple' => 'Hiển thị thêm kết quả tìm kiếm beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Tất cả diễn đàn',
            'link' => 'Tìm trong diễn đàn',
            'login_required' => 'Đăng nhập để tìm kiếm trong diễn đàn',
            'more_simple' => 'Hiển thị thêm kết quả tìm kiếm trong diễn đàn',
            'title' => 'Diễn Đàn',

            'label' => [
                'forum' => 'tìm trong diễn đần',
                'forum_children' => 'bao gồm diễn đàn con',
                'topic_id' => '# chủ đề',
                'username' => 'người đăng',
            ],
        ],

        'mode' => [
            'all' => 'tất cả',
            'beatmapset' => 'beatmap',
            'forum_post' => 'diễn đàn',
            'user' => 'người chơi',
            'wiki_page' => 'wiki',
        ],

        'user' => [
            'login_required' => 'Đăng nhập để tìm người dùng',
            'more' => 'còn :count kết quả tìm kiếm người chơi khác',
            'more_simple' => 'Hiển thị thêm kết quả tìm kiếm người chơi',
            'more_hidden' => 'Kết quả tìm kiếm người chơi chỉ hiện thị :max người chơi. Hãy thử tinh chỉnh truy vấn tìm kiếm.',
            'title' => 'Người Chơi',
        ],

        'wiki_page' => [
            'link' => 'Tìm trong wiki',
            'more_simple' => 'Hiển thị thêm kết quả tìm kiếm trong wiki',
            'title' => 'Wiki',
        ],
    ],

    'download' => [
        'tagline' => "hãy<br>bắt đầu!",
        'action' => 'Tải xuống osu!',

        'help' => [
            '_' => 'nếu bạn gặp vấn đề khi bắt đầu game hoặc tạo tài khoản, :help_forum_link hoặc :support_button.',
            'help_forum_link' => 'kiểm tra diễn đàng trợ giúp',
            'support_button' => 'liên hệ hỗ trợ',
        ],

        'os' => [
            'windows' => 'cho Windows',
            'macos' => 'cho macOS',
            'linux' => 'cho Linux',
        ],
        'mirror' => 'liên kết phụ',
        'macos-fallback' => 'người dùng macOS',
        'steps' => [
            'register' => [
                'title' => 'tạo tài khoản',
                'description' => 'làm theo những hướng dẫn khi bắt đầu trò chơi để đăng nhập hoặc tạo tài khoản mới',
            ],
            'download' => [
                'title' => 'tải xuống trò chơi',
                'description' => 'nhấp vào nút phía trên để tải xuống bộ cài đặt, sau đó mở nó!',
            ],
            'beatmaps' => [
                'title' => 'tải beatmaps',
                'description' => [
                    '_' => ':browse bộ sưu tập khổng lồ các beatmap được người chơi tạo ra và bắt đầu chơi!',
                    'browse' => 'duyệt qua',
                ],
            ],
        ],
        'video-guide' => 'hướng dẫn bằng video',
    ],

    'user' => [
        'title' => 'tổng quan',
        'news' => [
            'title' => 'Tin Tức',
            'error' => 'Có lỗi khi tải tin tức, thử tải lại trang xem?...',
        ],
        'header' => [
            'stats' => [
                'friends' => 'Bạn Bè Đang Online',
                'games' => 'Phòng',
                'online' => 'Người Chơi Đang Online',
            ],
        ],
        'beatmaps' => [
            'new' => 'Beatmap Được Xếp Hạng Mới',
            'popular' => 'Beatmaps Phổ Biến',
            'by_user' => 'bởi :user',
        ],
        'buttons' => [
            'download' => 'Tải Xuống osu!',
            'support' => 'Ủng Hộ osu!',
            'store' => 'osu!store',
        ],
    ],
];
