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
    'beatmapsets' => [
        'covers' => [
            'regenerate' => '重新生成',
            'regenerating' => '重新生成中⋯⋯',
            'remove' => '移除',
            'removing' => '移除中⋯⋯',
        ],
        'show' => [
            'covers' => '管理譜面封面',
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => '啟用',
                'activate_confirm' => '確認要為這個譜面啟用 Modding v2 嗎?',
                'active' => '已啟用',
                'inactive' => '未啟用',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => '刪除',

                'forum-name' => '論壇 #:id: :name',

                'no-cover' => '沒有封面',

                'submit' => [
                    'save' => '保存',
                    'update' => '更新',
                ],

                'title' => '論壇封面列表',

                'type-title' => [
                    'default-topic' => '預設板塊封面',
                    'main' => '論壇封面',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => '日誌查看器',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => '管理員控制台',

            'sections' => [
                'forum' => '論壇',
                'general' => '一般',
                'store' => '商店',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => '訂單列表',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => '該帳戶當前處於限制模式',
            'message' => '（只有管理員能看見這條信息）',
        ],
    ],

];
