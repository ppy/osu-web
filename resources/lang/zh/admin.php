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
        'show' => [
            'discussion' => [
                '_' => 'Modding v2',
                'activate' => '启用',
                'activate_confirm' => '确认要为这个谱面启用 Modding v2 吗?',
                'active' => '已启用',
                'inactive' => '未启用',
            ],
        ],
    ],

    'forum' => [
        'forum-covers' => [
            'index' => [
                'delete' => '删除',

                'forum-name' => '论坛 #:id: :name',

                'no-cover' => '没有封面',

                'submit' => [
                    'save' => '保存',
                    'update' => '更新',
                ],

                'title' => '论坛封面列表',

                'type-title' => [
                    'default-topic' => '默认话题封面',
                    'main' => '论坛封面',
                ],
            ],
        ],
    ],

    'logs' => [
        'index' => [
            'title' => '日志查看器',
        ],
    ],

    'pages' => [
        'root' => [
            'title' => '管理员控制台',

            'sections' => [
                'forum' => '论坛',
                'general' => '常规',
                'store' => '商店',
            ],
        ],
    ],

    'store' => [
        'orders' => [
            'index' => [
                'title' => '订单列表',
            ],
        ],
    ],

    'users' => [
        'restricted_banner' => [
            'title' => '该账户受限',
            'message' => '（只有管理员能看到这条消息）',
        ],
    ],

];
