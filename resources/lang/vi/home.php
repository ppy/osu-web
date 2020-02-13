<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'landing' => [
        'download' => 'Tải ngay',
        'online' => '<strong>:players</strong> đang chơi trong <strong>:games</strong> games',
        'peak' => 'Đỉnh điểm, :count người chơi online',
        'players' => '<strong>:count</strong> người chơi đã đăng kí',
        'title' => 'chào mừng',
        'see_more_news' => '',

        'slogan' => [
            'main' => 'game nhịp điệu free-to-win hay nhất',
            'sub' => 'chỉ bắt đầu bằng một cái click chuột',
        ],
    ],

    'search' => [
        'advanced_link' => 'Tìm kiếm nâng cao',
        'button' => 'Tìm kiếm ',
        'empty_result' => 'Không có kết quả!',
        'keyword_required' => '',
        'placeholder' => 'nhập để tìm kiếm',
        'title' => 'Tìm Kiếm',

        'beatmapset' => [
            'more' => 'còn :count kết quả tìm kiếm beatmap khác',
            'more_simple' => 'Hiển thị thêm kết quả tìm kiếm beatmap',
            'title' => 'Beatmaps',
        ],

        'forum_post' => [
            'all' => 'Tất cả diễn đàn',
            'link' => 'Tìm trong diễn đàn',
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
            'by_user' => '',
        ],
        'buttons' => [
            'download' => 'Tải Xuống osu!',
            'support' => 'Ủng Hộ osu!',
            'store' => 'osu!store',
        ],
    ],

    'support-osu' => [
        'title' => 'Wow!',
        'subtitle' => 'Dường như bạn đang có một khoảng thời gian vui vẻ! :D',
        'body' => [
            'part-1' => 'Bạn có biết rằng osu! không được vận hành dựa vào lợi nhuận quảng cáo, mà dựa vào sự ủng hộ của người chơi để hỗ trợ sự phát triển và chi phí hoạt động?',
            'part-2' => 'Và bạn có biết rằng bằng cách hỗ trợ osu! bạn nhận được hàng tá các tính năng hữu ích, chẳng hạn như <strong>tự động tải xuống trong game</strong> khi bạn trong chế độ theo dõi người chơi và trong chế độ multiplayer?',
        ],
        'find-out-more' => 'Nhấp vào đây để tìm hiểu thêm!',
        'download-starting' => "Ồ, và đừng lo lắng - quá trình tải xuống đã được bắt đầu cho bạn rồi ;)",
    ],
];
