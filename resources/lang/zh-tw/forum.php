<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'pinned_topics' => '置頂主題',
    'slogan' => "獨樂樂不如眾樂樂~",
    'subforums' => '其他相關討論',
    'title' => 'osu! 論壇',

    'covers' => [
        'edit' => '編輯封面',

        'create' => [
            '_' => '新增封面',
            'button' => '上傳圖片',
            'info' => '圖片尺寸應為 :dimensions。你也可以將圖片拉到此處來上傳。',
        ],

        'destroy' => [
            '_' => '移除封面',
            'confirm' => '您確定要刪除封面嗎？',
        ],
    ],

    'forums' => [
        'latest_post' => '最新貼文',

        'index' => [
            'title' => '論壇主頁',
        ],

        'topics' => [
            'empty' => '沒有主題！',
        ],
    ],

    'mark_as_read' => [
        'forum' => '將該板塊標記為已讀',
        'forums' => '將該板塊標記為已讀',
        'busy' => '標記為已讀…',
    ],

    'post' => [
        'confirm_destroy' => '刪除此回覆？',
        'confirm_restore' => '恢復此回覆？',
        'edited' => '最後由 :user 於 :when 編輯，總共編輯了 :count 次。',
        'posted_at' => '發表於 :when',
        'posted_by' => '由 :username 發布',

        'actions' => [
            'destroy' => '刪除回覆',
            'edit' => '編輯回覆',
            'report' => '檢舉貼文',
            'restore' => '恢復回覆',
        ],

        'create' => [
            'title' => [
                'reply' => '新回覆',
            ],
        ],

        'info' => [
            'post_count' => ':count_delimited 主題',
            'topic_starter' => '主題開啟者',
        ],
    ],

    'search' => [
        'go_to_post' => '前往該樓層',
        'post_number_input' => '輸入樓層數',
        'total_posts' => '一共有 :posts_count 樓',
    ],

    'topic' => [
        'confirm_destroy' => '確定要刪除這個主題嗎？',
        'confirm_restore' => '確定要復原這個主題嗎？',
        'deleted' => '已刪除的主題',
        'go_to_latest' => '查看最後的貼文',
        'has_replied' => '您已回覆此主題',
        'in_forum' => '目前看板[ :forum ]',
        'latest_post' => ':when :user',
        'latest_reply_by' => '最後回覆: :user',
        'new_topic' => '發表新主題',
        'new_topic_login' => '登入以發表新主題',
        'post_reply' => '發表',
        'reply_box_placeholder' => '輸入回覆',
        'reply_title_prefix' => 'Re',
        'started_by' => '發表人： :user',
        'started_by_verbose' => '由 :user 發起',

        'actions' => [
            'destroy' => '刪除主題',
            'restore' => '復原主題',
        ],

        'create' => [
            'close' => '關閉',
            'preview' => '預覽',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => '編輯',
            'submit' => '發表',

            'necropost' => [
                'default' => '此主題不被討論一段時間了。如非有特殊理由，請勿在此回覆。',

                'new_topic' => [
                    '_' => "此主題不被討論一段時間了。如果你沒有在這裡回文的具體理由, 請用 :create 代替。",
                    'create' => '建立一個新的主題',
                ],
            ],

            'placeholder' => [
                'body' => '在這裡輸入內文',
                'title' => '點擊這裡編輯標題',
            ],
        ],

        'jump' => [
            'enter' => '點擊這裡跳轉到指定的回覆',
            'first' => '返回頂部',
            'last' => '跳至最後',
            'next' => '往後 10 篇',
            'previous' => '往前 10 篇',
        ],

        'post_edit' => [
            'cancel' => '取消',
            'post' => '儲存',
        ],
    ],

    'topic_watches' => [
        'index' => [
            'title_compact' => '訂閱',

            'box' => [
                'total' => '訂閱的主題',
                'unread' => '主題有新回覆',
            ],

            'info' => [
                'total' => '共訂閱了 :total 個主題',
                'unread' => '有 :unread 個未讀回覆',
            ],
        ],

        'topic_buttons' => [
            'remove' => [
                'confirmation' => '取消訂閱該主題？',
                'title' => '取消訂閱',
            ],
        ],
    ],

    'topics' => [
        '_' => '主題',

        'actions' => [
            'login_reply' => '登入以回覆',
            'reply' => '回覆',
            'reply_with_quote' => '引用此回覆',
            'search' => '搜尋',
        ],

        'create' => [
            'create_poll' => '建立投票',

            'preview' => '主題預覽',

            'create_poll_button' => [
                'add' => '建立投票',
                'remove' => '取消建立投票',
            ],

            'poll' => [
                'hide_results' => '隱藏投票結果。',
                'hide_results_info' => '這些內容只在投票結束後顯示。',
                'length' => '投票持續',
                'length_days_suffix' => '天',
                'length_info' => '若無截止期限則留空',
                'max_options' => '最多可選數',
                'max_options_info' => '每個人最多可選的數量。',
                'options' => '選項',
                'options_info' => '一個選項佔一行，最多10個選項。',
                'title' => '問題',
                'vote_change' => '允許修改',
                'vote_change_info' => '允許投票者修改他們的投票。',
            ],
        ],

        'edit_title' => [
            'start' => '編輯標題',
        ],

        'index' => [
            'feature_votes' => '星級優先',
            'replies' => '回覆數',
            'views' => '瀏覽數',
        ],

        'issue_tag_added' => [
            'to_0' => '移除 "added" 標籤',
            'to_0_done' => '已移除 "added" 標籤',
            'to_1' => '新增 "added" 標籤',
            'to_1_done' => '已新增 "added" 標籤',
        ],

        'issue_tag_assigned' => [
            'to_0' => '移除 "assigned" 標籤',
            'to_0_done' => '已移除 "assigned" 标签',
            'to_1' => '新增 "assigned" 標籤',
            'to_1_done' => '已新增 "assigned" 標籤',
        ],

        'issue_tag_confirmed' => [
            'to_0' => '移除 "confirmed" 標籤',
            'to_0_done' => '已移除 "confirmed" 標籤',
            'to_1' => '新增 "confirmed" 標籤',
            'to_1_done' => '已新增 "confirmed" 標籤',
        ],

        'issue_tag_duplicate' => [
            'to_0' => '移除 "duplicate" 標籤',
            'to_0_done' => '已移除 "duplicate" 標籤',
            'to_1' => '新增 "duplicate" 標籤',
            'to_1_done' => '已新增 "duplicate" 標籤',
        ],

        'issue_tag_invalid' => [
            'to_0' => '移除 "invalid" 標籤',
            'to_0_done' => '已移除 "invalid" 標籤',
            'to_1' => '新增 "invalid" 標籤',
            'to_1_done' => '已新增 "invalid" 標籤',
        ],

        'issue_tag_resolved' => [
            'to_0' => '移除 "resolved" 標籤',
            'to_0_done' => '已移除 "resolved" 標籤',
            'to_1' => '新增 "resolved" 標籤',
            'to_1_done' => '已新增 "resolved" 標籤',
        ],

        'lock' => [
            'is_locked' => '主題已被鎖定，不能回覆',
            'to_0' => '解鎖主题',
            'to_0_confirm' => '解鎖主題?',
            'to_0_done' => '主题已經解鎖',
            'to_1' => '鎖定主题',
            'to_1_confirm' => '鎖定主題?',
            'to_1_done' => '主题已被鎖定',
        ],

        'moderate_move' => [
            'title' => '將主題移動至其他討論',
        ],

        'moderate_pin' => [
            'to_0' => '取消置頂',
            'to_0_confirm' => '取消置頂主題?',
            'to_0_done' => '該主题已取消置頂',
            'to_1' => '置頂',
            'to_1_confirm' => '置頂主題?',
            'to_1_done' => '該主题已置頂',
            'to_2' => '至頂並標記為公告',
            'to_2_confirm' => '置頂主題並設為公告?',
            'to_2_done' => '該主题已置頂並標記為公告',
        ],

        'moderate_toggle_deleted' => [
            'show' => '顯示已刪除帖子',
            'hide' => '隱藏已刪除帖子',
        ],

        'show' => [
            'deleted-posts' => '刪除主題',
            'total_posts' => '總主題數量',

            'feature_vote' => [
                'current' => '當前優先順序: +:count',
                'do' => '提升這個請求',

                'info' => [
                    '_' => '這是一個:feature_request。:supporters 可為新功能建議投票。',
                    'feature_request' => '新功能建議',
                    'supporters' => '贊助者',
                ],

                'user' => [
                    'count' => '{0} 沒有票|[1,*] :count 票',
                    'current' => '剩下 :votes 票.',
                    'not_enough' => "沒有票了",
                ],
            ],

            'poll' => [
                'edit' => '編輯投票',
                'edit_warning' => '編輯投票將會清除目前結果！',
                'vote' => '投票',

                'button' => [
                    'change_vote' => '更改投票',
                    'edit' => '編輯投票',
                    'view_results' => '直接跳到結果',
                    'vote' => '投票',
                ],

                'detail' => [
                    'end_time' => '將於 :time 結束',
                    'ended' => '結束於 :time',
                    'results_hidden' => '結果將於投票結束後顯示。',
                    'total' => '總票數: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '未訂閱',
            'to_watching' => '訂閱',
            'to_watching_mail' => '訂閱並開啟電子郵件通知',
            'tooltip_mail_disable' => '通知已啟用。點擊以禁用。',
            'tooltip_mail_enable' => '通知已禁用。點擊以啟用。',
        ],
    ],
];
