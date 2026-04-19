<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'none' => '未找到群組歷史！',
    'view' => '查看群組歷史',

    'event' => [
        'actor' => '操作員：:user',

        'message' => [
            'group_add' => '建立:group。',
            'group_remove' => '已刪除:group。',
            'group_rename' => ':previous_group 已被重新命名為 :group。',
            'user_add' => ':user 已加入 :group。',
            'user_add_with_playmodes' => ':user 已成為 :rulesets 模式的 :group 。',
            'user_add_playmodes' => '已新增 :rulesets 模式到 :user 於 :group 的身分中 。',
            'user_remove' => ':user 已退出 :group。',
            'user_remove_playmodes' => '已自 :user 於 :group 的身分中移除 :rulesets 模式。',
            'user_set_default' => ':user 的預設群組已設定為 :group 。',
        ],
    ],

    'form' => [
        'group' => '群組',
        'group_all' => '所有群組',
        'max_date' => '至',
        'min_date' => '從',
        'user' => '使用者',
        'user_prompt' => '使用者名稱或ID',
    ],

    'staff_log' => [
        '_' => '更早期的群組歷史可以在 :wiki_articles 中找到。',
        'wiki_articles' => '工作人員日誌',
    ],
];
