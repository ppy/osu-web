<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'authorizations' => [
        'update' => [
            'null_user' => '编辑前请先登录。',
            'system_generated' => '无法编辑系统回复。',
            'wrong_user' => '只有作者可以编辑。',
        ],
    ],

    'events' => [
        'empty' => '目前还没有什么事件……呢。',
    ],

    'index' => [
        'deleted_beatmap' => '删除',
        'title' => '谱面讨论',

        'form' => [
            '_' => '搜索',
            'deleted' => '包含已经删除的讨论',
            'only_unresolved' => '',
            'types' => '评论类型',
            'username' => '用户名',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => '用户',
                'overview' => '活动总览',
            ],
        ],
    ],

    'item' => [
        'created_at' => '发帖时间',
        'deleted_at' => '删帖时间',
        'message_type' => '类型',
        'permalink' => '永久链接',
    ],

    'nearby_posts' => [
        'confirm' => '在这个时间点上没有相关的讨论记录。',
        'notice' => '在 :timestamp 附近（:existing_timestamps）有讨论记录，发表前请检查。',
    ],

    'reply' => [
        'open' => [
            'guest' => '登录以回复',
            'user' => '回复',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '被 :user 标记为 “已解决”',
            'false' => '被 :user 重新打开',
        ],
    ],

    'user_filter' => [
        'everyone' => '所有人',
        'label' => '按用户筛选',
    ],
];
