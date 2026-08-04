<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => '未找到相关的用户组历史记录！',
    'view' => '查看用户组历史记录',

    'event' => [
        'actor' => '操作人：  :user',

        'message' => [
            'group_add' => '已创建用户组 :group 。',
            'group_remove' => '已删除用户组 :group 。',
            'group_rename' => '用户组 :previous_group 被重命名为 :group 。',
            'user_add' => ':user 已被添加至 :group 用户组。',
            'user_add_with_playmodes' => ':user 已成为 :rulesets 模式的 :group 。',
            'user_add_playmodes' => '已新增 :rulesets 模式到 :user 于 :group 的身份中 。',
            'user_remove' => ':user 已从 :group 用户组中被移除。',
            'user_remove_playmodes' => '已从 :user 于 :group 的身份中移除 :rulesets 模式。',
            'user_set_default' => ':user 的默认用户组已被设置为 :group 。',
        ],
    ],

    'form' => [
        'group' => '用户组',
        'group_all' => '所有用户组',
        'max_date' => '结束日期',
        'min_date' => '开始日期',
        'user' => '用户',
        'user_prompt' => '用户名或 ID',
    ],

    'staff_log' => [
        '_' => '更早的用户组历史记录可以在 :wiki_articles 中找到。',
        'wiki_articles' => '“工作人员日志”百科条目',
    ],
];
