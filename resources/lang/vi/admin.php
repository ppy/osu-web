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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => 'Phục hồi',
            'regenerating' => 'Đang phục hồi...',
            'remove' => 'Gỡ bỏ',
            'removing' => 'Đang gỡ bỏ...',
            'title' => '',
        ],
        'show' => [
            'covers' => 'Quản lý Các ảnh bìa của Beatmapset',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => 'kích hoạt',
                'activate_confirm' => 'kích hoạt modding v2 cho beatmap này?',
                'active' => 'active',
                'inactive' => 'inactive',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => 'Xóa',

                'forum-name' => 'Diễn đàn #:id: :name',

                'no-cover' => 'Không có ảnh bìa',

                'submit' => [
                    'save' => 'Lưu lại',
                    'update' => 'Cập nhật',
                ],

                'title' => 'Danh Sách Các Ảnh Cover của Diễn Đàn',

                'type-title' => [
                    'default-topic' => 'Ảnh Cover Mặc Định cho Bài Viết',
                    'main' => 'Ảnh Bìa của Diễn Đàn',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => 'Lưu Trữ về Người Xem',
        ],
    ],

    'pages' => [
        'root' => [
            'sections' => [
                'beatmapsets' => '',
                'forum' => 'Diễn đàn',
                'general' => 'Thông tin chung',
                'store' => 'Cửa hàng',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => 'Danh Sách Đơn Hàng',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => 'Người dùng đang bị restricted.',
            'message' => '(chỉ có admin mới có thể thấy)',
        ],
    ],

];
