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
            'only_unresolved' => '只显示未解决的讨论',
            'types' => '评论类型',
            'username' => '用户名',

            'beatmapset_status' => [
                '_' => '谱面状态',
                'all' => '所有',
                'disqualified' => '已被Disqualified',
                'never_qualified' => '从未被Qualified',
                'qualified' => '已被Qualified',
                'ranked' => '已被Ranked',
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

    'review' => [
        'go_to_parent' => '查看审阅帖',
        'go_to_child' => '查看讨论',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '被 :user 标记为 “已解决”',
            'false' => '被 :user 重新打开',
        ],
    ],

    'timestamp_display' => [
        'general' => '常规（当前难度）',
        'general_all' => '常规（所有难度）',
    ],

    'user_filter' => [
        'everyone' => '所有人',
        'label' => '按用户筛选',
    ],
];
