<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
    'pinned_topics' => '置頂主題',
    'slogan' => "獨樂樂不如眾樂樂~",
    'subforums' => '其他相關討論',
    'title' => 'osu! 論壇',

    'covers' => [
        'create' => [
            '_' => '新增封面',
            'button' => '上傳圖片',
            'info' => '圖片尺寸應為 :dimensions. 也可以將圖片拉到此處上傳.',
        ],

        'destroy' => [
            '_' => '移除封面',
            'confirm' => '您確定要刪除封面嗎？',
        ],
    ],

    'email' => [
        'new_reply' => '[osu!] 主題 ":title" 有新回覆',
    ],

    'forums' => [
        'topics' => [
            'empty' => '沒有主題！',
        ],
    ],

    'post' => [
        'confirm_destroy' => '刪除此回覆？',
        'confirm_restore' => '恢復此回覆？',
        'edited' => '最後由 :user 於 :when 編輯，總共編輯了 :count 次。',
        'posted_at' => '發表於 :when',

        'actions' => [
            'destroy' => '刪除回覆',
            'restore' => '恢復回覆',
            'edit' => '編輯回覆',
        ],
    ],

    'search' => [
        'go_to_post' => '前往該樓層',
        'post_number_input' => '輸入樓層數',
        'total_posts' => '一共有 :posts_count 樓',
    ],

    'topic' => [
        'deleted' => '已刪除的主題',
        'go_to_latest' => '查看最後的貼文',
        'latest_post' => ':when :user',
        'latest_reply_by' => '最後回覆: :user',
        'new_topic' => '發表新主題',
        'new_topic_login' => '登錄以發表新主題',
        'post_reply' => '發表',
        'reply_box_placeholder' => '輸入回覆',
        'reply_title_prefix' => '',
        'started_by' => '發表人： :user',
        'started_by_verbose' => '',

        'create' => [
            'preview' => '預覽',
            // TL note: this is used in the topic reply preview, when
            // the user goes back from previewing to editing the reply
            'preview_hide' => '編輯',
            'submit' => '發表',

            'necropost' => [
                'default' => '',

                'new_topic' => [
                    '_' => "",
                    'create' => '',
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
            'title' => '訂閱的主題',
            'title_compact' => '訂閱',
            'title_main' => '<strong>訂閱</strong>主題',

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

            'create_poll_button' => [
                'add' => '建立投票',
                'remove' => '取消建立投票',
            ],

            'poll' => [
                'length' => '投票持續',
                'length_days_suffix' => '天',
                'length_info' => '如果無期限則留空',
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
            'views' => '瀏覽數',
            'replies' => '回覆數',
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
            'to_0_done' => '主题已經解鎖',
            'to_1' => '鎖定主题',
            'to_1_done' => '主题已被鎖定',
        ],

        'moderate_move' => [
            'title' => '將主題移動至其他討論',
        ],

        'moderate_pin' => [
            'to_0' => '取消置頂',
            'to_0_done' => '該主题已取消置頂',
            'to_1' => '置頂',
            'to_1_done' => '該主题已置頂',
            'to_2' => '至頂並標記為公告',
            'to_2_done' => '該主题已置頂並標記為公告',
        ],

        'show' => [
            'deleted-posts' => '刪除主題',
            'total_posts' => '總主題數量',

            'feature_vote' => [
                'current' => '當前優先順序: +:count',
                'do' => '提升這個請求',

                'user' => [
                    'count' => '{0} 沒有票|[1,*] :count 票',
                    'current' => '剩下 :votes 票.',
                    'not_enough' => "沒有票了",
                ],
            ],

            'poll' => [
                'vote' => '投票',

                'detail' => [
                    'end_time' => '將於 :time 結束',
                    'ended' => '結束於 :time',
                    'total' => '總票數: :count',
                ],
            ],
        ],

        'watch' => [
            'to_not_watching' => '未訂閱',
            'to_watching' => '訂閱',
            'to_watching_mail' => '訂閱並開啟電子郵件通知',
            'mail_disable' => '關閉電子郵件通知',
        ],
    ],
];
