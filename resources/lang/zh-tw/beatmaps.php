<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'change_owner' => [
        'too_many' => '',
    ],

    'discussion-votes' => [
        'update' => [
            'error' => '投票更新失敗',
        ],
    ],

    'discussions' => [
        'allow_kudosu' => '給予 kudosu',
        'beatmap_information' => '圖譜頁面',
        'delete' => '刪除',
        'deleted' => '被 :editor 於 :delete_time 刪除。',
        'deny_kudosu' => '收回 kudosu',
        'edit' => '編輯',
        'edited' => '最後由 :editor 在 :update_time 編輯。',
        'guest' => '由 :user 製作的客串難度',
        'kudosu_denied' => 'kudosu 被收回',
        'message_placeholder_deleted_beatmap' => '該難度已被刪除，無法繼續討論',
        'message_placeholder_locked' => '此圖譜的討論已被停用。',
        'message_placeholder_silenced' => "禁言時無法發布討論。",
        'message_type_select' => '選擇回覆類型',
        'reply_notice' => '按下 Enter 以回覆',
        'reply_resolve_notice' => '按下 Enter 以回覆。按下 Ctrl+Enter 以回覆並標記為解決。',
        'reply_placeholder' => '在此處輸入您的回覆',
        'require-login' => '登入以發文或回覆',
        'resolved' => '已解決',
        'restore' => '已修復',
        'show_deleted' => '顯示已刪除的訊息',
        'title' => '討論區',
        'unresolved_count' => ':count_delimited 個未解決問題',

        'collapse' => [
            'all-collapse' => '全部摺疊',
            'all-expand' => '全部展開',
        ],

        'empty' => [
            'empty' => '還沒有討論！',
            'hidden' => '沒有符合過濾條件的討論。',
        ],

        'lock' => [
            'button' => [
                'lock' => '鎖定討論',
                'unlock' => '解鎖討論',
            ],

            'prompt' => [
                'lock' => '鎖定原因',
                'unlock' => '確定要解鎖嗎？',
            ],
        ],

        'message_hint' => [
            'in_general' => '這則貼文將發布至一般圖譜討論區。如要針對此難度提供修改意見，請在訊息開頭加上時間戳記（例如：00:12:345）。',
            'in_timeline' => '如要針對多個時間戳記提供修改意見，請分多次發布訊息（每個時間戳記一則貼文）。',
        ],

        'message_placeholder' => [
            'general' => '在這裡輸入以發布至整體 (:version)',
            'generalAll' => '在這裡輸入以發布至整體（所有難度）',
            'review' => '在這裡輸入以發布評論',
            'timeline' => '在這裡輸入以發布至時間軸 (:version)',
        ],

        'message_type' => [
            'disqualify' => '取消提名',
            'hype' => '推薦！',
            'mapper_note' => '備註',
            'nomination_reset' => '重置提名',
            'praise' => '讚',
            'problem' => '問題',
            'problem_warning' => '回報問題',
            'review' => '評論',
            'suggestion' => '建議',
        ],

        'message_type_title' => [
            'disqualify' => '取消提名',
            'hype' => '推薦！',
            'mapper_note' => '發布備註',
            'nomination_reset' => '刪除所有提名',
            'praise' => '表揚',
            'problem' => '問題',
            'problem_warning' => '問題警告',
            'review' => '評論',
            'suggestion' => '建議',
        ],

        'mode' => [
            'events' => '歷史',
            'general' => '整體:scope',
            'reviews' => '評論',
            'timeline' => '時間軸',
            'scopes' => [
                'general' => '目前難度',
                'generalAll' => '所有難度',
            ],
        ],

        'new' => [
            'pin' => '釘選',
            'timestamp' => '時間戳',
            'timestamp_missing' => '在編輯模式下按下 Ctrl+C，然後貼到你的訊息中即可加入時間戳記！',
            'title' => '新的討論',
            'unpin' => '取消釘選',
        ],

        'review' => [
            'new' => '新評論',
            'embed' => [
                'delete' => '刪除',
                'missing' => '[該討論已移除]',
                'unlink' => '取消連結',
                'unsaved' => '尚未儲存',
                'timestamp' => [
                    'all-diff' => '發布於「所有難度」的無法進行時間戳記',
                    'diff' => '如果這則貼文以時間戳記開頭，它將顯示在時間軸下方。',
                ],
            ],
            'insert-block' => [
                'paragraph' => '插入段落',
                'praise' => '插入表揚',
                'problem' => '插入問題',
                'suggestion' => '插入建議',
            ],
        ],

        'show' => [
            'title' => '由 :mapper 製作的 :title',
        ],

        'sort' => [
            'created_at' => '建立時間',
            'timeline' => '時間軸',
            'updated_at' => '最後更新',
        ],

        'stats' => [
            'deleted' => '已刪除',
            'mapper_notes' => '備註',
            'mine' => '我的',
            'pending' => '未解決',
            'praises' => '表揚',
            'resolved' => '已解決',
            'total' => '全部',
        ],

        'status-messages' => [
            'approved' => '這張圖譜在 :date 獲得核准！',
            'graveyard' => "這張圖譜自 :date 就未更新了，或許它已經被作者拋棄了 ;w;",
            'loved' => '這張圖譜於 :date 被加入到社群喜愛分類！',
            'ranked' => '這張圖譜於 :date 進榜！',
            'wip' => '注意：這張圖譜被作者標記為製作中（半成品）',
        ],

        'votes' => [
            'none' => [
                'down' => '沒有任何反對票',
                'up' => '還沒有任何贊成票',
            ],
            'latest' => [
                'down' => '最新的反對票',
                'up' => '最新的贊成票',
            ],
        ],
    ],

    'hype' => [
        'button' => '推薦圖譜！',
        'button_done' => '已經推薦！',
        'confirm' => "你確定嗎？這將會使用你剩下的 :n 次推薦次數並且無法取消。",
        'explanation' => '推薦這張圖譜讓它更容易被提名和進榜！',
        'explanation_guest' => '登入並推薦這張圖譜，讓它更容易被提名並進榜！',
        'new_time' => "你將在 :new_time 後獲得新的推薦次數。",
        'remaining' => '你還可以推薦 :remaining 次。',
        'required_text' => '推薦進度： :current/:required',
        'section_title' => '推薦進度',
        'title' => '推薦',
    ],

    'feedback' => [
        'button' => '留下建議',
    ],

    'nominations' => [
        'already_nominated' => '您已經提名過這張圖譜了',
        'cannot_nominate' => '您不能提名這個遊戲模式的圖譜',
        'delete' => '刪除',
        'delete_own_confirm' => '你確定嗎？這張圖譜將被刪除，刪除後你將重新導向到你的個人檔案頁面。',
        'delete_other_confirm' => '你確定嗎？這張圖譜將被刪除，刪除後你將重新導向到他的個人檔案頁面。',
        'disqualification_prompt' => '請說明取消資格的原因。',
        'disqualified_at' => '於 :time_ago 被取消資格（:reason）。',
        'disqualified_no_reason' => '沒有指定原因',
        'disqualify' => '取消提名',
        'incorrect_state' => '執行該操作時發生錯誤，請嘗試重新整理頁面。',
        'love' => '社群喜愛',
        'love_choose' => '選擇要移入社群喜愛狀態的難度',
        'love_confirm' => '喜歡這張圖譜嗎？',
        'nominate' => '提名',
        'nominate_confirm' => '確定要提名這張圖譜？',
        'nominated_by' => '被 :users 提名',
        'not_enough_hype' => "沒有足夠的推薦。",
        'remove_from_loved' => '從社群喜愛中移除',
        'remove_from_loved_prompt' => '從社群喜愛中移除的原因：',
        'required_text' => '提名數：:current/:required',
        'reset_message_deleted' => '已刪除',
        'title' => '提名狀態',
        'unresolved_issues' => '請先處理圖譜中待解決的問題。',

        'rank_estimate' => [
            '_' => '如果沒有發現問題，這張圖譜預計會在 :date 進榜。它在 :queue 中排名第 #:position。',
            'unresolved_problems' => '除非已解決 :problems，否則這張圖譜會一直處於已提名狀態。',
            'problems' => '這些問題',
            'on' => '在:date',
            'queue' => '排名佇列',
            'soon' => '不久後',
        ],

        'reset_at' => [
            'nomination_reset' => '提名程序已由 :user 在 :time_ago 重設，新的問題是 :discussion (:message)。',
            'disqualify' => '由 :user 在 :time_ago 取消資格，新的問題是 :discussion (:message)。',
        ],

        'reset_confirm' => [
            'disqualify' => '你確定嗎？這將把譜面從合格狀態移除並重設提名程序。',
            'nomination_reset' => '你確定嗎？提出新的問題將重設提名程序。',
            'problem_warning' => '你確定要回報這個譜面的問題嗎？這會通知圖譜管理團隊 (BN)。',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '輸入關鍵字...',
            'login_required' => '登入以搜尋。',
            'options' => '更多搜尋選項',
            'supporter_filter' => '使用 :filters 進行篩選需要有效的 osu!supporter 標籤',
            'not-found' => '沒有結果',
            'not-found-quote' => '… 呃，什麼都沒找到。',
            'filters' => [
                'extra' => '其他資訊',
                'general' => '一般',
                'genre' => '曲風',
                'language' => '語言',
                'mode' => '模式',
                'nsfw' => '成人內容',
                'played' => '玩過',
                'rank' => '成績',
                'status' => '分類',
            ],
            'sorting' => [
                'title' => '曲名',
                'artist' => '演出者',
                'difficulty' => '難度',
                'favourites' => '我的最愛',
                'updated' => '已更新',
                'ranked' => '進榜',
                'rating' => '評分',
                'plays' => '遊玩次數',
                'relevance' => '相關度',
                'nominations' => '提名狀態',
            ],
            'supporter_filter_quote' => [
                '_' => '使用 :filters 進行篩選需要有效的 :link',
                'link_text' => 'osu! 贊助者標籤',
            ],
        ],
    ],
    'general' => [
        'converts' => '包括轉換圖譜',
        'featured_artists' => '精選藝術家',
        'follows' => '已訂閱的圖譜製作者',
        'recommended' => '推薦難度',
        'spotlights' => '聚光燈圖譜',
    ],
    'mode' => [
        'all' => '全部',
        'any' => '所有',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
        'undefined' => '未設定',
    ],
    'status' => [
        'any' => '所有',
        'approved' => '已核准',
        'favourites' => '收藏',
        'graveyard' => '拋棄',
        'leaderboard' => '擁有排行榜',
        'loved' => '社群喜愛',
        'mine' => '我的圖譜',
        'pending' => '待處理',
        'wip' => '尚未完工 (WIP)',
        'qualified' => '提名',
        'ranked' => '已進榜',
    ],
    'genre' => [
        'any' => '所有',
        'unspecified' => '未指定',
        'video-game' => '電子遊戲',
        'anime' => '動畫',
        'rock' => '搖滾',
        'pop' => '流行樂',
        'other' => '其他',
        'novelty' => '新奇',
        'hip-hop' => '嘻哈',
        'electronic' => '電音',
        'metal' => '重金屬',
        'classical' => '古典樂',
        'folk' => '民謠',
        'jazz' => '爵士樂',
    ],
    'language' => [
        'any' => '所有',
        'english' => '英文',
        'chinese' => '漢語',
        'french' => '法文',
        'german' => '德文',
        'italian' => '義大利文',
        'japanese' => '日文',
        'korean' => '韓文',
        'spanish' => '西班牙文',
        'swedish' => '瑞典文',
        'russian' => '俄文',
        'polish' => '波蘭文',
        'instrumental' => '樂器演奏',
        'other' => '其他',
        'unspecified' => '未指定',
    ],

    'nsfw' => [
        'exclude' => '隱藏',
        'include' => '顯示',
    ],

    'played' => [
        'any' => '所有',
        'played' => '玩過',
        'unplayed' => '未曾玩過',
    ],
    'extra' => [
        'video' => '有影像',
        'storyboard' => '有 Storyboard',
    ],
    'rank' => [
        'any' => '所有',
        'XH' => '白銀 SS',
        'X' => '',
        'SH' => '白銀 S',
        'S' => '',
        'A' => '',
        'B' => '',
        'C' => '',
        'D' => '',
    ],
    'panel' => [
        'playcount' => '遊玩次數：:count',
        'favourites' => '收藏次數：:count',
    ],
    'variant' => [
        'mania' => [
            '4k' => '4K',
            '7k' => '7K',
            'all' => '全部',
        ],
    ],
];
