<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => '編輯前請先登入。',
            'system_generated' => '無法編輯系統發表的貼文。',
            'wrong_user' => '只有作者可以編輯。',
        ],
    ],

    'events' => [
        'empty' => '什麼都還沒有發生…',
    ],

    'index' => [
        'deleted_beatmap' => '已刪除',
        'none_found' => '找不到符合條件的討論內容',
        'title' => '圖譜討論',

        'form' => [
            '_' => '搜尋',
            'deleted' => '包括已經刪除的討論',
            'mode' => '圖譜遊戲模式',
            'only_unresolved' => '只顯示未解決的討論',
            'show_review_embeds' => '顯示審核貼文',
            'types' => '訊息類別',
            'username' => '使用者名稱',

            'beatmapset_status' => [
                '_' => '圖譜狀態',
                'all' => '全部',
                'disqualified' => '取消資格',
                'never_qualified' => '從未合格',
                'qualified' => '已合格',
                'ranked' => '已進榜',
            ],

            'user' => [
                'label' => '使用者',
                'overview' => '活動總覽',
            ],
        ],
    ],

    'item' => [
        'created_at' => '發表日期',
        'deleted_at' => '刪除日期',
        'message_type' => '類型',
        'permalink' => '固定連結',
    ],

    'nearby_posts' => [
        'confirm' => '在這個時間點上沒有相關的討論記錄。',
        'notice' => '在 :timestamp 附近(:existing_timestamps)有討論記錄，發表前請檢查。',
        'unsaved' => '這個審核中有 :count',
    ],

    'owner_editor' => [
        'button' => '難度擁有者',
        'reset_confirm' => '要重設這個難度的擁有者嗎？',
        'user' => '擁有者',
        'version' => '難度',
    ],

    'refresh' => [
        'checking' => '檢查更新...',
        'has_updates' => '這個討論區有更新，按這裡重新整理。',
        'no_updates' => '沒有更新',
        'updating' => '正在更新...',
    ],

    'reply' => [
        'open' => [
            'guest' => '登入以回覆',
            'user' => '回覆',
        ],
    ],

    'review' => [
        'block_count' => '已使用 :used / :max 個區塊',
        'go_to_parent' => '查看其他人的審核',
        'go_to_child' => '查看討論',
        'validation' => [
            'block_too_large' => '每個區塊最多只能有 :limit 個字元',
            'external_references' => '審核有指向不屬於這個審核的議題',
            'invalid_block_type' => '區塊類型無效',
            'invalid_document' => '審核無效',
            'invalid_discussion_type' => '討論類型不正確',
            'minimum_issues' => '審核時必須指出最少 :count 個問題',
            'missing_text' => '這個板塊缺少文字',
            'too_many_blocks' => '審核最多只能有 :count 個段落或議題|審核最多只能有 :count 個段落或議題',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => '被 :user 標記為 “已解決”',
            'false' => '被 :user 標記為「未解決」',
        ],
    ],

    'timestamp_display' => [
        'general' => '一般',
        'general_all' => '一般（所有難度）',
    ],

    'user_filter' => [
        'everyone' => '所有人',
        'label' => '依使用者篩選',
    ],
];
