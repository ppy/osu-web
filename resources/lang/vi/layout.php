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
    'defaults' => [
        'page_description' => 'osu! - Chỉ bắt đầu bằng một cái *click* chuột!  Với Ouendan/EBA, Taiko và những chế độ chơi nguyên bản, cũng như một level editor đầy đủ chức năng.',
    ],

    'header' => [
        'admin' => [
            '_' => '',
            'beatmapset' => '',
            'beatmapset_covers' => '',
            'contest' => '',
            'contests' => '',
            'root' => '',
            'store_orders' => '',
        ],

        'artists' => [
            '_' => '',
            'index' => '',
        ],

        'beatmapsets' => [
            '_' => '',
            'discussions' => '',
            'index' => '',
            'show' => '',
            'packs' => '',
        ],

        'changelog' => [
            '_' => '',
            'index' => '',
        ],

        'community' => [
            '_' => 'Cộng đồng',
            'comments' => '',
            'contests' => '',
            'forum' => 'Diễn đàn',
            'livestream' => '',
        ],

        'error' => [
            '_' => '',
        ],

        'help' => [
            '_' => '',
            'index' => '',
        ],

        'home' => [
            '_' => '',
            'password_reset' => '',
        ],

        'matches' => [
            '_' => '',
        ],

        'notice' => [
            '_' => '',
        ],

        'notifications' => [
            '_' => '',
            'index' => '',
        ],

        'rankings' => [
            '_' => '',
        ],

        'store' => [
            '_' => '',
            'cart' => '',
            'order' => '',
            'orders' => '',
            'product' => '',
            'products' => '',
        ],

        'tournaments' => [
            '_' => '',
            'index' => '',
        ],

        'users' => [
            '_' => '',
            'forum_posts' => '',
            'modding' => '',
            'show' => '',
        ],
    ],

    'gallery' => [
        'close' => '',
        'fullscreen' => '',
        'zoom' => '',
        'previous' => '',
        'next' => '',
    ],

    'menu' => [
        'home' => [
            '_' => 'trang chủ',
            'account-edit' => 'cài đặt',
            'account-verifyLink' => '',
            'beatmapset-watches-index' => '',
            'changelog-build' => 'build',
            'changelog-index' => 'changelog',
            'client_verifications-create' => '',
            'forum-topic-watches-index' => '',
            'friends-index' => 'bạn bè',
            'getDownload' => 'tải xuống',
            'getIcons' => 'biểu tượng',
            'groups-show' => 'nhóm',
            'index' => 'tổng quan',
            'legal-show' => 'thông tin',
            'messages-index' => 'tin nhắn',
            'news-index' => 'tin tức',
            'news-show' => 'tin tức',
            'password-reset-index' => 'đặt lại mật khẩu',
            'search' => 'tìm kiếm',
            'supportTheGame' => 'ủng hộ osu!',
            'team' => 'team',
            'testflight' => '',
        ],
        'profile' => [
            '_' => '',
            'friends' => '',
            'settings' => '',
        ],
        'help' => [
            '_' => 'trợ giúp',
            'getFaq' => 'faq',
            'getRules' => 'quy tắc',
            'getSupport' => 'không, thật đó, tôi cần giúp đỡ!',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'artists' => 'nghệ sĩ tiêu biểu',
            'beatmap_discussion_posts-index' => 'bài đăng góc thảo luận beatmap',
            'beatmap_discussions-index' => 'góc thảo luận beatmap',
            'beatmapset_discussion_votes-index' => 'bình chọn góc thảo luận beatmap',
            'beatmapset_events-index' => 'sự kiện beatmapset',
            'index' => 'danh sách',
            'packs' => 'gói',
            'show' => 'thông tin',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'xếp hạng',
            'index' => 'performance',
            'performance' => 'performance',
            'charts' => 'tiêu điểm',
            'score' => 'điểm',
            'country' => 'quốc gia',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'cộng đồng',
            'chat' => 'chat',
            'chat-index' => 'chat',
            'dev' => 'phát triển',
            'getForum' => 'diễn đàn',
            'getLive' => 'live stream',
            'comments-index' => 'bình luận',
            'comments-show' => 'bình luận',
            'contests' => 'cuộc thi',
            'profile' => 'trang cá nhân',
            'tournaments' => 'giải đấu',
            'tournaments-index' => 'giải đấu',
            'tournaments-show' => 'thông tin giải đấu',
            'forum-topics-create' => 'diễn đàn',
            'forum-topics-show' => 'diễn đàn',
            'forum-forums-index' => 'diễn đàn',
            'forum-forums-show' => 'diễn đàn',
        ],
        'multiplayer' => [
            '_' => 'multiplayer',
            'show' => 'trận đấu ',
        ],
        'error' => [
            '_' => 'lỗi',
            '404' => 'không tìm thấy',
            '403' => 'cấm',
            '401' => 'trái phép',
            '405' => 'không tìm thấy',
            '500' => 'có gì đó bị hỏng',
            '503' => 'bảo trì',
        ],
        'user' => [
            '_' => 'người chơi',
            'getLogin' => 'đăng nhập',
            'disabled' => 'đã tắt',

            'register' => 'đăng kí',
            'reset' => 'khôi phục',
            'new' => 'mới',

            'help' => 'Trợ Giúp',
            'logout' => 'Đăng Xuất',
            'messages' => 'Tin Nhắn',
            'modding-history-discussions' => 'thảo luận modding của người dùng',
            'modding-history-events' => 'sự kiện modding của người dùng',
            'modding-history-index' => 'lịch sử modding của người dùng',
            'modding-history-posts' => 'bài đăng modding của người dùng',
            'modding-history-votesGiven' => 'modding votes đã cho của người dùng',
            'modding-history-votesReceived' => 'modding votes đã nhận của người dùng',
            'notifications-index' => '',
            'oauth_login' => 'đăng nhập cho oauth',
            'oauth_request' => 'ủy quyền oauth',
            'settings' => 'Cài Đặt',
        ],
        'store' => [
            '_' => 'cửa hàng',
            'checkout-show' => 'thanh toán',
            'getListing' => 'danh sách',
            'cart-show' => 'giỏ hàng',

            'getCheckout' => 'thanh toán',
            'getInvoice' => 'hóa đơn',
            'orders-index' => 'lịch sử đơn hàng',
            'products-show' => 'mặt hàng',

            'new' => 'mới',
            'home' => 'trang chủ',
            'index' => 'trang chủ',
            'thanks' => 'cảm ơn',
        ],
        'admin-forum' => [
            '_' => 'admin::forum',
            'forum-covers-index' => 'bìa diễn đàn',
        ],
        'admin-store' => [
            '_' => 'admin::store',
            'orders-index' => 'đơn hàng',
            'orders-show' => 'đơn hàng',
        ],
        'admin' => [
            '_' => 'admin',
            'beatmapsets-covers' => 'bìa beatmapset',
            'logs-index' => 'log',
            'root' => 'mục lục',

            'beatmapsets' => [
                '_' => 'beatmapsets',
                'show' => 'chi tiết',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Tổng quát',
            'home' => 'Trang Chủ',
            'changelog-index' => 'Changelog',
            'beatmaps' => 'Danh Sách Beatmap',
            'download' => 'Tải Xuống osu!',
            'wiki' => 'Wiki',
        ],
        'help' => [
            '_' => 'Giúp Đỡ & Cộng Đồng',
            'faq' => 'Những Câu Hỏi Thường Gặp',
            'forum' => 'Diễn Đàn',
            'livestreams' => 'Live Streams',
            'report' => 'Báo Cáo Một Vấn Đề',
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
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => "Khi cần thiết, đây là một đoạn code bạn có thể cung cấp để được hỗ trợ!",
    ],

    'popup_login' => [
        'login' => [
            'forgot' => "Quên mật khẩu",
            'password' => 'password',
            'title' => 'Đăng Nhập Để Tiếp Tục',
            'username' => '',

            'error' => [
                'email' => "Tài khoản hoặc địa chỉ email không tồn tại",
                'password' => 'Sai mật khẩu',
            ],
        ],

        'register' => [
            'download' => '',
            'info' => 'Bạn cần một tài khoản. Tại sao bạn lại không có chứ?',
            'title' => "Chưa có tài khoản?",
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Cài Đặt',
            'friends' => 'Bạn Bè',
            'logout' => 'Đăng Xuất',
            'profile' => 'Trang Cá Nhân',
        ],
    ],

    'popup_search' => [
        'initial' => 'Nhập để tìm kiếm!',
        'retry' => 'Tìm kiếm thất bại. Nhấp vào đây để thử lại.',
    ],
];
