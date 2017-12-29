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
    'defaults' => [
        'page_description' => 'osu! - Chỉ bắt đầu bằng một cái *click* chuột!  Cùng với Ouendan/EBA, Taiko và những chế độ chơi nguyên bản, cùng với một level editor có đầy đủ chức năng.',
    ],

    'menu' => [
        'home' => [
            '_' => 'trang chủ',
            'account-edit' => 'cài đặt',
            'friends' => 'bạn bè',
            'friends-index' => 'bạn bè',
            'changelog-index' => 'changelog',
            'changelog-show' => 'bản dựng',
            'getDownload' => 'tải xuống',
            'getIcons' => 'biểu tượng',
            'groups-show' => 'nhóm',
            'index' => 'osu!',
            'legal-show' => 'thông tin',
            'news-index' => 'tin tức',
            'news-show' => 'tin tức',
            'password-reset-index' => 'đặt lại mật khẩu',
            'search' => 'tìm kiếm',
            'supportTheGame' => 'ủng hộ osu!',
        ],
        'help' => [
            '_' => 'trợ giúp',
            'getFaq' => 'faq',
            'getSupport' => 'hỗ trợ',
            'getWiki' => 'wiki',
            'wiki-show' => 'wiki',
        ],
        'beatmaps' => [
            '_' => 'beatmaps',
            'show' => 'thông tin',
            'index' => 'danh sách',
            'artists' => 'nghệ sĩ tiêu biểu',
            'packs' => 'gói',
            'beatmapset-watches-index' => 'theo dõi modding',
            // 'getCharts' => 'charts',
        ],
        'beatmapsets' => [
            '_' => 'beatmaps',
            'discussion' => 'modding',
        ],
        'rankings' => [
            '_' => 'xếp hạng',
            'index' => 'performance',
            'performance' => 'performance',
            'charts' => 'charts',
            'score' => 'điểm',
            'country' => 'quốc gia',
            'kudosu' => 'kudosu',
        ],
        'community' => [
            '_' => 'cộng đồng',
            'dev' => 'osu!dev',
            'getForum' => 'forum',
            'getChat' => 'chat',
            'getSupport' => 'hỗ trợ',
            'getLive' => 'trực tiếp',
            'contests' => 'cuộc thi',
            'profile' => 'hồ sơ',
            'tournaments' => 'giải đấu',
            'tournaments-index' => 'giải đấu',
            'tournaments-show' => 'thông tin giải đấu',
            'forum-topic-watches-index' => 'đăng kí',
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
            '405' => 'không tìm thấy', //giống 404?
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

            'messages' => 'Tin Nhắn',
            'settings' => 'Cài Đặt',
            'logout' => 'Đăng Xuất',
            'help' => 'Trợ Giúp',
        ],
        'store' => [
            '_' => 'store',
            'checkout-index' => 'thanh toán',
            'getListing' => 'danh sách',
            'getCart' => 'giỏ hàng',

            'getCheckout' => 'thanh toán',
            'getInvoice' => 'hóa đơn',
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
            'root' => 'mục lục',
            'logs-index' => 'log',
            'beatmapsets' => [
                '_' => 'beatmapsets',
                'show' => 'chi tiết',
            ],
        ],
    ],

    'footer' => [
        'general' => [
            '_' => 'Chung',
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
        'support' => [
            '_' => 'Ủng Hộ osu!',
            'tags' => 'Supporter Tags',
            'merchandise' => 'Hàng Hóa',
        ],
        'legal' => [
            '_' => 'Tình Trạng Pháp Lý',
            'copyright' => 'Bản Quyền (DMCA)',
            'osu_status' => '@osustatus',
            'server_status' => 'Trạng Thái Server',
            'terms' => 'Điều Khoản Và Điều Kiện',
        ],
    ],

    'errors' => [
        '404' => [
            'error' => 'Không Tìm Thấy Trang',
            'description' => 'Xin lỗi, nhưng trang bạn yêu cầu không có ở đây!',
            'link' => false,
        ],
        '403' => [
            'error' => 'Bạn không nên ở đây.',
            'description' => 'Nhưng bạn vẫn có thể thử quay trở lại mà.',
            'link' => false,
        ],
        '401' => [
            'error' => 'Bạn không nên ở đây.',
            'description' => 'Nhưng bạn vẫn có thể thử quay trở lại mà. Hoặc có thể đăng nhập vào.',
            'link' => false,
        ],
        '405' => [
            'error' => 'Không Tìm Thấy Trang',
            'description' => 'Xin lỗi, nhưng trang bạn yêu cầu không có ở đây!',
            'link' => false,
        ],
        '500' => [
            'error' => 'Ồ không! Có gì đó đã bị hỏng! ;_;',
            'description' => 'Chúng tôi sẽ được tự động thông báo về mọi lỗi.',
            'link' => false,
        ],
        'fatal' => [
            'error' => 'Ồ không! Có gì đó đã bị hỏng (rất tệ)! ;_;',
            'description' => 'Chúng tôi sẽ được tự động thông báo về mọi lỗi.',
            'link' => false,
        ],
        '503' => [
            'error' => 'Đang bảo trì!',
            'description' => 'Thông thường bảo trì sẽ tốn từ 5 giây đến 10 phút ở bất cứ đâu. Nếu chúng tôi vẫn chưa trở lại sau khoảng thời gian trên, truy cập :link để biết thêm thông tin.',
            'link' => [
                'text' => '@osustatus',
                'href' => 'https://twitter.com/osustatus',
            ],
        ],
        // used by sentry if it returns an error
        'reference' => 'Khi cần thiết, đây là một đoạn code bạn có thể đưa cho người giúp đỡ!',
    ],

    'popup_login' => [
        'login' => [
            'email' => 'địa chỉ email',
            'forgot' => 'Quên mật khẩu',
            'password' => 'password',
            'title' => 'Đăng Nhập Để Tiếp Tục',

            'error' => [
                'email' => 'Không tồn tại username hoặc địa chỉ email',
                'password' => 'Sai mật khẩu',
            ],
        ],

        'register' => [
            'info' => 'Bạn cần một tài khoản. Tại sao bạn lại không có một cái chứ?',
            'title' => 'Chưa có tài khoản?',
        ],
    ],

    'popup_user' => [
        'links' => [
            'account-edit' => 'Cài Đặt',
            'friends' => 'Bạn Bè',
            'logout' => 'Đăng Xuất',
            'profile' => 'Hồ Sơ Của Tôi',
        ],
    ],

    'popup_search' => [
        'initial' => 'Nhập để tìm kiếm!',
        'retry' => 'Tìm kiếm thất bại. Bấm vào đây để thử lại.',
    ],
];
