<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => '編輯前請先登入。',
            'system_generated' => '無法編輯系統發佈的貼文。',
            'wrong_user' => '只有作者可以編輯。',
        ],
    ],

    'events' => [
        'empty' => '還沒有事件...',
    ],

    'index' => [
        'deleted_beatmap' => '已刪除',
        'none_found' => '找不到符合條件的討論內容',
        'title' => '圖譜討論',

        'form' => [
            '_' => '搜尋',
            'deleted' => '包含已經刪除的討論',
            'mode' => '圖譜遊戲模式',
            'only_unresolved' => '只顯示未解決的討論',
            'types' => '訊息類別',
            'username' => '使用者名稱',

            'beatmapset_status' => [
                '_' => '圖譜狀態',
                'all' => '全部',
                'disqualified' => 'Disqualified',
                'never_qualified' => 'Never Qualified',
                'qualified' => 'Qualified',
                'ranked' => '已進榜',
            ],

            'user' => [
                'label' => '用戶',
                'overview' => '活動總覽',
            ],
        ],
    ],

    'item' => [
        'created_at' => '發佈日期',
        'deleted_at' => '刪除日期',
        'message_type' => '類型',
        'permalink' => '固定連結',
    ],

    'nearby_posts' => [
        'confirm' => '在這個時間點上沒有相關的討論記錄。',
        'notice' => '在 :timestamp 附近（:existing_timestamps）有討論記錄，發表前請檢查。',
        'unsaved' => '',
    ],

    'reply' => [
        'open' => [
            'guest' => '登入以回覆',
            'user' => '回覆',
        ],
    ],

    'review' => [
        'block_count' => '已耗用 :used / :max 個方塊',
        'go_to_parent' => '檢視其他人的評論',
        'go_to_child' => '查看討論',
        'validation' => [
            'block_too_large' => '',
            'external_references' => '',
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '被 :user 標記為 “已解決”',
            'false' => '被 :user 標記為 “未解決”',
        ],
    ],

    'timestamp_display' => [
        'general' => '一般',
        'general_all' => '一般(所有)',
    ],

    'user_filter' => [
        'everyone' => '所有人',
        'label' => '按使用者篩選',
    ],
];
