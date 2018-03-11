<?php

/**
 *    Copyright 2015-2017 ppy Pty. Ltd.
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
    'slogan' => '獨樂樂不如眾樂樂~',
    'subforums' => '子版塊',
    'title' => 'osu! 社區',

    'covers' => [
        'create' => [
            '_' => '設置封面',
            'button' => '上傳圖片',
            'info' => '圖片尺寸應為 :dimensions. 也可以將圖片拖動到這裡上傳.',
        ],

        'destroy' => [
            '_' => '移除封面',
            'confirm' => '移除這個封面？',
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
        'go_to_latest' => '查看最後的帖子',
        'latest_post' => ':when :user',
        'latest_reply_by' => '最後回覆: :user',
        'new_topic' => '發表新主題',
        'post_reply' => '發表',
        'reply_box_placeholder' => '輸入回覆',
        'started_by' => '發帖人： :user',

        'create' => [
            'preview' => '預覽',
            'preview_hide' => '編輯',
            'submit' => '發表',

            'placeholder' => [
                'body' => '在這裡輸入正文',
                'title' => '點擊這裡設置標題',
            ],
        ],

        'jump' => [
            'enter' => '點擊這裡跳轉到指定回覆',
            'first' => '跳轉到第一條回覆',
            'last' => '跳轉到最後一條回覆',
            'next' => '向後 10 條',
            'previous' => '向前 10 條',
        ],

        'post_edit' => [
            'cancel' => '取消',
            'post' => '保存',
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
            'reply' => '回覆',
            'reply_with_quote' => '引用以回覆',
            'search' => '搜索',
        ],

        'create' => [
            'create_poll' => '創建投票',

            'create_poll_button' => [
                'add' => '創建投票',
                'remove' => '取消創建投票',
            ],

            'poll' => [
                'length' => '投票持續',
                'length_days_prefix' => '',
                'length_days_suffix' => '天',
                'length_info' => '如果無期限則留空',
                'max_options' => '最大可選數',
                'max_options_info' => '填寫每個人最多可以選的選項數。',
                'options' => '選項',
                'options_info' => '一個選項佔一行，最多10個選項。',
                'title' => '問題',
                'vote_change' => '允許修改',
                'vote_change_info' => '如果選中，則用戶可以更改他們的投票。',
            ],
        ],

        'edit_title' => [
            'start' => '編輯標題',
        ],

        'index' => [
            'views' => '查看數',
            'replies' => '回覆數',
        ],

        'issue_tag_added' => [ //TODO 所有的issue_tag_xxx都需要上下文
            'action-0' => '移除 "added" 標籤',
            'action-1' => '添加 "added" 標籤',
            'state-0' => '已移除 "added" 標籤',
            'state-1' => '已添加 "added" 標籤',
        ],

        'issue_tag_assigned' => [
            'action-0' => '移除 "assigned" 標籤',
            'action-1' => '添加 "assigned" 標籤',
            'state-0' => '已移除 "assigned" 標籤',
            'state-1' => '已添加 "assigned" 標籤',
        ],

        'issue_tag_confirmed' => [
            'action-0' => '移除 "confirmed" 標籤',
            'action-1' => '添加 "confirmed" 標籤',
            'state-0' => '已移除 "confirmed" 標籤',
            'state-1' => '已添加 "confirmed" 標籤',
        ],

        'issue_tag_duplicate' => [
            'action-0' => '移除 "duplicate" 標籤',
            'action-1' => '添加 "duplicate" 標籤',
            'state-0' => '已移除 "duplicate" 標籤',
            'state-1' => '已添加 "duplicate" 標籤',
        ],

        'issue_tag_invalid' => [
            'action-0' => '移除 "invalid" 標籤',
            'action-1' => '添加 "invalid" 標籤',
            'state-0' => '已移除 "invalid" 標籤',
            'state-1' => '已添加 "invalid" 標籤',
        ],

        'issue_tag_resolved' => [
            'action-0' => '移除 "resolved" 標籤',
            'action-1' => '添加 "resolved" 標籤',
            'state-0' => '已移除 "resolved" 標籤',
            'state-1' => '已添加 "resolved" 標籤',
        ],

        'lock' => [
            'is_locked' => '主題已被鎖定，不能回覆',
            'lock-0' => '解鎖主題',
            'lock-1' => '鎖定主題',
            'state-0' => '主題已經解鎖',
            'state-1' => '主題已被鎖定',
        ],

        'moderate_move' => [
            'title' => '將主題移動到其他板塊',
        ],

        'moderate_pin' => [
            'pin-0' => '取消置頂',
            'pin-1' => '置頂',
            'pin-2' => '置頂並標記為公告',
            'state-0' => '該主題已取消置頂',
            'state-1' => '該主題已置頂',
            'state-2' => '該主題已置頂並標記為公告',
        ],

        'show' => [
            'deleted-posts' => '刪除主題',
            'total_posts' => '總主題數量',

            'feature_vote' => [
                'current' => '當前優先級: +:count',
                'do' => '提升這個請求',

                'user' => [
                    'count' => '{0} 沒有票|[1,*] :count 票',
                    'current' => '還有 :votes 票.',
                    'not_enough' => '沒有票了',
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
            'state-0' => '已取消訂閱！',
            'state-1' => '訂閱成功！',
            'watch-0' => '取消訂閱',
            'watch-1' => '訂閱',
        ],
    ],
];
