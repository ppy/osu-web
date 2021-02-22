<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'audio' => [
        'autoplay' => 'Chơi bản nhạc tiếp theo tự động',
    ],

    'defaults' => [
        'page_description' => 'osu! - Chỉ bắt đầu bằng một cái *click* chuột!  Với Ouendan/EBA, Taiko và những chế độ chơi nguyên bản, cũng như một level editor đầy đủ chức năng.',
    ],

    'header' => [
        'admin' => [
            'beatmapset' => 'beatmapset',
            'beatmapset_covers' => 'bìa beatmapset',
            'contest' => 'cuộc thi',
            'contests' => 'các cuộc thi',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            'index' => 'danh sách',
        ],

        'changelog' => [
            'index' => 'danh sách',
        ],

        'help' => [
            'index' => 'mục lục',
            'sitemap' => '',
        ],

        'store' => [
            'cart' => 'giỏ hàng',
            'orders' => 'lịch sử đơn hàng',
            'products' => 'mặt hàng',
        ],

        'tournaments' => [
            'index' => 'danh sách',
        ],

        'users' => [
            'modding' => 'modding',
            'show' => 'thông tin',
        ],
    ],

    'gallery' => [
        'close' => 'Đóng (Esc)',
        'fullscreen' => 'Bật/tắt toàn màn hình',
        'zoom' => 'Thu phóng',
        'previous' => 'Trước (mũi tên trái)',
        'next' => 'Tiếp theo (mũi tên phải)',
    ],

    'menu' => [
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'nghệ sĩ tiêu biểu',
            'index' => 'danh sách',
            'packs' => 'gói',
        ],
        'community' => [
            '_' => 'cộng đồng',
            'chat' => 'chat',
            'contests' => 'cuộc thi',
            'dev' => 'phát triển',
            'forum-forums-index' => 'diễn đàn',
            'getLive' => 'live stream',
            'tournaments' => 'giải đấu',
        ],
        'help' => [
            '_' => 'trợ giúp',
            'getAbuse' => 'báo cáo lạm dụng',
            'getFaq' => 'faq',
            'getRules' => 'quy tắc',
            'getSupport' => 'không, thật đó, tôi cần giúp đỡ!',
            'getWiki' => 'wiki',
        ],
        'home' => [
            '_' => 'trang chủ',
            'changelog-index' => 'changelog',
            'getDownload' => 'tải xuống',
            'news-index' => 'tin tức',
            'search' => 'tìm kiếm',
            'team' => 'team',
        ],
        'rankings' => [
            '_' => 'xếp hạng',
            'charts' => 'tiêu điểm',
            'country' => 'quốc gia',
            'index' => 'performance',
            'kudosu' => 'kudosu',
            'multiplayer' => '',
            'score' => 'điểm',
        ],
        'store' => [
            '_' => 'cửa hàng',
            'cart-show' => 'giỏ hàng',
            'getListing' => 'danh sách',
            'orders-index' => 'lịch sử đơn hàng',
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Tổng quát',
            'home' => 'Trang Chủ',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Danh Sách Beatmap',
            'download' => 'Tải Xuống osu!',
        ],
        'help' => [
            '_' => 'Giúp Đỡ & Cộng Đồng',
            'faq' => 'Những Câu Hỏi Thường Gặp',
            'forum' => 'Diễn Đàn',
            'livestreams' => 'Live Streams',
            'report' => 'Báo Cáo Một Vấn Đề',
            'wiki' => 'Wiki',
        ],
        'legal' => [
            '_' => 'Pháp Lý & Trạng Thái',
            'copyright' => 'Bản Quyền (DMCA)',
            'privacy' => 'Quyền Riêng Tư',
            'server_status' => 'Trạng Thái Server',
            'source_code' => 'Mã Nguồn',
            'terms' => 'Điều Khoản Và Điều Kiện',
        ],
    ],

    'errors' => [
        '400' => [
            'error' => '',
            'description' => '',
        ],
        '404' => [
            'error' => 'Không Tìm Thấy Trang',
            'description' => "Xin lỗi, nhưng trang bạn yêu cầu không có ở đây!",
        ],
        '403' => [
            'error' => "Bạn không nên ở đây.",
            'description' => 'Nhưng bạn vẫn có thể thử quay trở lại mà.',
        ],
        '401' => [
            'error' => "Bạn không nên ở đây.",
            'description' => 'Nhưng bạn vẫn có thể thử quay trở lại mà. Hoặc có thể đăng nhập vào.',
        ],
        '405' => [
            'error' => 'Không Tìm Thấy Trang',
            'description' => "Xin lỗi, nhưng trang bạn yêu cầu không có ở đây!",
        ],
        '422' => [
            'error' => '',
            'description' => '',
        ],
        '429' => [
            'error' => '',
            'description' => '',
        ],
        '500' => [
            'error' => 'Ồ không! Có gì đó đã bị hỏng! ;_;',
            'description' => "Chúng tôi sẽ được tự động thông báo về mọi lỗi.",
        ],
        'fatal' => [
            'error' => 'Ồ không! Có gì đó đã bị hỏng (rất tệ)! ;_;',
            'description' => "Chúng tôi sẽ được tự động thông báo về mọi lỗi.",
        ],
        '503' => [
            'error' => 'Đang bảo trì!',
            'description' => "Thông thường bảo trì sẽ tốn khoảng 5 giây đến 10 phút. Nếu chúng tôi vẫn chưa trở lại sau khoảng thời gian trên, truy cập :link để biết thêm thông tin.",
            'link' => [
                'text' => '',
                'href' => '',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Khi cần thiết, đây là một đoạn code bạn có thể cung cấp để được hỗ trợ!",
    ],

    'popup_login' => [
        'button' => '',

        'login' => [
            'forgot' => "Quên mật khẩu",
            'password' => 'password',
            'title' => 'Đăng Nhập Để Tiếp Tục',
            'username' => 'tên người dùng',

            'error' => [
                'email' => "Tài khoản hoặc địa chỉ email không tồn tại",
                'password' => 'Sai mật khẩu',
            ],
        ],

        'register' => [
            'download' => 'Tải xuống',
            'info' => 'Bạn cần một tài khoản. Tại sao bạn lại không có chứ?',
            'title' => "Chưa có tài khoản?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Cài Đặt',
            'follows' => '',
            'friends' => 'Bạn bè',
            'logout' => 'Đăng Xuất',
            'profile' => 'Trang Cá Nhân',
        ],
    ],

    'popup_search' => [
        'initial' => 'Nhập để tìm kiếm!',
        'retry' => 'Tìm kiếm thất bại. Nhấp vào đây để thử lại.',
    ],
];
