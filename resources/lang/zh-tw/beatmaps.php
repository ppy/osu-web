<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
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
        'edited' => '最後由 :editor 編輯於 :update_time 。',
        'guest' => '由 :user 製作的客串難度',
        'kudosu_denied' => 'kudosu 被收回',
        'message_placeholder_deleted_beatmap' => '該難度已被刪除，無法繼續討論',
        'message_placeholder_locked' => '此圖譜的討論已被禁用。',
        'message_placeholder_silenced' => "帳戶被禁言，無法發佈討論。",
        'message_type_select' => '選擇回覆類型',
        'reply_notice' => '按下 Enter 以回覆',
        'reply_placeholder' => '在此處輸入您的回覆',
        'require-login' => '回覆前請先登入。',
        'resolved' => '已解決',
        'restore' => '已修復',
        'show_deleted' => '顯示刪除的項目',
        'title' => '討論區',

        'collapse' => [
            'all-collapse' => '收回全部',
            'all-expand' => '展開全部',
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
                'lock' => '鎖定的原因',
                'unlock' => '確認解鎖？',
            ],
        ],

        'message_hint' => [
            'in_general' => '這篇貼文將發佈到圖譜討論區中。如需要檢查此圖譜某個特定部分，請在開頭加入時間戳 (例如: 00:12:345)。',
            'in_timeline' => '每篇貼文僅加入一個時間戳，如需要檢查多個時間戳，請將時間戳分別發佈至不同貼文，並寫下發表意見。',
        ],

        'message_placeholder' => [
            'general' => '在此處輸入以發佈至整體 (:version)',
            'generalAll' => '在此處輸入以發佈至整體 (所有難度)',
            'review' => '',
            'timeline' => '在此處輸入以發佈至時間軸 (:version)',
        ],

        'message_type' => [
            'disqualify' => '取消提名',
            'hype' => '推薦！',
            'mapper_note' => '備註',
            'nomination_reset' => '重置提名',
            'praise' => '讚',
            'problem' => '問題',
            'review' => '評論',
            'suggestion' => '建議',
        ],

        'mode' => [
            'events' => '歷史',
            'general' => '整體:scope',
            'reviews' => '評論',
            'timeline' => '時間線',
            'scopes' => [
                'general' => '目前難度',
                'generalAll' => '所有難度',
            ],
        ],

        'new' => [
            'pin' => '釘選',
            'timestamp' => '時間戳',
            'timestamp_missing' => '在編輯模式下按 Ctrl+C 並至您輸入的對話框中按 Ctrl+V 以加入時間戳！',
            'title' => '新的討論',
            'unpin' => '取消釘選',
        ],

        'review' => [
            'new' => '',
            'embed' => [
                'delete' => '刪除',
                'missing' => '',
                'unlink' => '取消連結',
                'unsaved' => '尚未儲存',
                'timestamp' => [
                    'all-diff' => '',
                    'diff' => '',
                ],
            ],
            'insert-block' => [
                'paragraph' => '插入段落',
                'praise' => '',
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
            'approved' => '這張圖譜於 :date 被批准!',
            'graveyard' => "這張圖譜自 :date 就未更新了，或許它已經被作者拋棄了 ;w;",
            'loved' => '這張圖譜於 :date 被 Loved !',
            'ranked' => '這張圖譜於 :date 進榜了!',
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
        'confirm' => "你確定嗎？這將會使用你剩下的 :n 次推薦次數並且無法撤銷。",
        'explanation' => '推薦這張圖譜讓它更容易被提名和進榜 ！',
        'explanation_guest' => '登入並推薦這張圖譜讓它更容易被提名和進榜 ！',
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
        'delete' => '刪除',
        'delete_own_confirm' => '你確定嗎？這個圖譜將被刪除，刪除後你將重新導向到你的個人資料頁面。',
        'delete_other_confirm' => '你確定嗎？這個圖譜將被刪除，刪除後你將重新導向到他的個人資料頁面。',
        'disqualification_prompt' => 'Disqualified 的理由？',
        'disqualified_at' => '於 :time_ago 被 Disqualified（:reason）。',
        'disqualified_no_reason' => '沒有任何原因',
        'disqualify' => 'Disqualify',
        'incorrect_state' => '操作發生錯誤，請重新載入頁面。',
        'love' => '喜歡',
        'love_confirm' => '喜歡這張圖譜嗎？',
        'nominate' => '提名',
        'nominate_confirm' => '確定要提名這張圖譜？',
        'nominated_by' => '被 :users 提名',
        'not_enough_hype' => "沒有足夠的推薦。",
        'remove_from_loved' => '',
        'remove_from_loved_prompt' => '',
        'required_text' => '提名數: :current/:required',
        'reset_message_deleted' => '已刪除',
        'title' => '提名狀態',
        'unresolved_issues' => '仍然有需解決的問題 。',

        'rank_estimate' => [
            '_' => '',
            'queue' => '',
            'soon' => '不久後',
        ],

        'reset_at' => [
            'nomination_reset' => '提名於 :time_ago 被新問題 :discussion 重置。',
            'disqualify' => ':time_ago  :user 因新问题 :discussion (:message) 而被 DQ.',
        ],

        'reset_confirm' => [
            'nomination_reset' => '你確定嗎？提出新的問題會重置提名。',
            'disqualify' => '你確定嗎？這個會移除圖譜從進榜和重設提名進度。',
        ],
    ],

    'listing' => [
        'search' => [
            'prompt' => '輸入關鍵字...',
            'login_required' => '登入以搜尋。',
            'options' => '更多搜尋選項',
            'supporter_filter' => '按 :filters 篩選需要擁有有效的贊助者標籤',
            'not-found' => '沒有結果',
            'not-found-quote' => '姆....，什麼也沒有。',
            'filters' => [
                'extra' => '其他資訊',
                'general' => '一般',
                'genre' => '曲風',
                'language' => '語言',
                'mode' => '模式',
                'nsfw' => '',
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
                '_' => '按 :filters 篩選需先成為 :link',
                'link_text' => 'osu! 贊助者標籤',
            ],
        ],
    ],
    'general' => [
        'converts' => '包括轉換圖譜',
        'follows' => '訂閱的作圖者',
        'recommended' => '推薦難度',
    ],
    'mode' => [
        'all' => '全部',
        'any' => '所有',
        'osu' => '',
        'taiko' => '',
        'fruits' => '',
        'mania' => '',
    ],
    'status' => [
        'any' => '所有',
        'approved' => '批准',
        'favourites' => '收藏',
        'graveyard' => '拋棄',
        'leaderboard' => '擁有排行榜',
        'loved' => 'Loved',
        'mine' => '我的圖譜',
        'pending' => '待處理&製作中',
        'qualified' => 'Qualified',
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
    'mods' => [
        '4K' => '',
        '5K' => '',
        '6K' => '',
        '7K' => '',
        '8K' => '',
        '9K' => '',
        'AP' => '',
        'DT' => '',
        'EZ' => '',
        'FI' => '',
        'FL' => '',
        'HD' => '',
        'HR' => '',
        'HT' => '',
        'MR' => '',
        'NC' => '',
        'NF' => '',
        'NM' => '',
        'PF' => '',
        'RX' => 'Relax',
        'SD' => '',
        'SO' => '',
        'TD' => '',
        'V2' => 'Score V2',
    ],
    'language' => [
        'any' => '所有',
        'english' => '英語',
        'chinese' => '漢語',
        'french' => '法語',
        'german' => '德語',
        'italian' => '意大利語',
        'japanese' => '日語',
        'korean' => '韓語',
        'spanish' => '西班牙語',
        'swedish' => '瑞典語',
        'russian' => '俄語',
        'polish' => '波蘭語',
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
