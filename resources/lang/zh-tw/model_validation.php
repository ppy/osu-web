<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'invalid' => '所指定的 :attribute 無效。',
    'not_negative' => ':attribute 不能為負數。',
    'required' => '需要 :attribute 。',
    'too_long' => ':attribute 超出最大長度——最多允許 :limit 個字符。',
    'wrong_confirmation' => '確認信息不匹配。',

    'beatmapset_discussion' => [
        'beatmap_missing' => '指定了時間戳但是譜面不存在。',
        'beatmapset_no_hype' => "無法推薦譜面。",
        'hype_requires_null_beatmap' => '只能在 常規（全難度） 中推薦。',
        'invalid_beatmap_id' => '指定的難度無效。',
        'invalid_beatmapset_id' => '指定的譜面無效。',
        'locked' => '討論被鎖定。',

        'attributes' => [
            'message_type' => '訊息類型',
            'timestamp' => '時間戳',
        ],

        'hype' => [
            'discussion_locked' => "該圖譜目前為鎖定討論狀態，無法被推薦",
            'guest' => '登錄後才能推薦',
            'hyped' => '你已經推薦了這張譜面',
            'limit_exceeded' => '你已經用光了推薦次數',
            'not_hypeable' => '這張譜面無法推薦',
            'owner' => '不能推薦你自己的譜面',
        ],

        'timestamp' => [
            'exceeds_beatmapset_length' => '指定的時間戳不在譜面範圍內。',
            'negative' => "無法定位時間戳。",
        ],
    ],

    'beatmapset_discussion_post' => [
        'discussion_locked' => '討論被鎖定。',
        'first_post' => '無法刪除第一個討論。',

        'attributes' => [
            'message' => '訊息',
        ],
    ],

    'comment' => [
        'deleted_parent' => '無法回覆給已刪除評論。',
        'top_only' => '不允許回覆置頂評論。',

        'attributes' => [
            'message' => '訊息',
        ],
    ],

    'follow' => [
        'invalid' => '所指定的 :attribute 無效。',
    ],

    'forum' => [
        'feature_vote' => [
            'not_feature_topic' => '只能給新特性請求投票。',
            'not_enough_feature_votes' => '票數不足。',
        ],

        'poll_vote' => [
            'invalid' => '指定的選項無效。',
        ],

        'post' => [
            'beatmapset_post_no_delete' => '不允許刪除譜面信息帖。',
            'beatmapset_post_no_edit' => '不允許編輯圖譜信息帖。',
            'first_post_no_delete' => '無法刪除第一則貼文。',
            'missing_topic' => '貼文缺少主題',
            'only_quote' => '您的回覆僅有引用。',

            'attributes' => [
                'post_text' => '貼文主體',
            ],
        ],

        'topic' => [
            'attributes' => [
                'topic_title' => '主題標題',
            ],
        ],

        'topic_poll' => [
            'duplicate_options' => '不允許重複的選項。',
            'grace_period_expired' => '無法修改超過 :limit 個小時的投票。',
            'hiding_results_forever' => '無法隱藏不會完結之投票的結果',
            'invalid_max_options' => '每人可選的選項不能超出總選項數。',
            'minimum_one_selection' => '每人至少可選一項。',
            'minimum_two_options' => '需要至少兩個選項。',
            'too_many_options' => '選項數量超出限制。',

            'attributes' => [
                'title' => '投票標題',
            ],
        ],

        'topic_vote' => [
            'required' => '至少選擇一項以投票',
            'too_many' => '選項數量超出限制。',
        ],
    ],

    'oauth' => [
        'client' => [
            'too_many' => 'OAuth 應用程式數量超出限制。',
            'url' => '請輸入有效的 URL。',

            'attributes' => [
                'name' => '應用程式名稱',
                'redirect' => '應用程式回傳 URL',
            ],
        ],
    ],

    'user' => [
        'contains_username' => '密碼不能包含使用者名稱。',
        'email_already_used' => '郵箱已被使用。',
        'email_not_allowed' => '電子郵件地址不允許。',
        'invalid_country' => '國家未被數據庫收錄。',
        'invalid_discord' => 'Discord 用户名無效。',
        'invalid_email' => "無效的郵箱地址。",
        'invalid_twitter' => 'Twitter帳戶名無效',
        'too_short' => '新密碼太短。',
        'unknown_duplicate' => '用戶名或郵箱已被使用。',
        'username_available_in' => '該用戶名將在 :duration 後可用。',
        'username_available_soon' => '該用戶名即將可用！',
        'username_invalid_characters' => '用戶名中包含非法字符。',
        'username_in_use' => '用戶名已經被使用！',
        'username_locked' => '使用者名稱已被使用！', // TODO: language for this should be slightly different.
        'username_no_space_userscore_mix' => '請在下劃線和空格間選一個，不要混用！',
        'username_no_spaces' => "用戶名不能以空格開頭或結束。",
        'username_not_allowed' => '不允許使用該用戶名。',
        'username_too_short' => '使用者名稱太短。',
        'username_too_long' => '用戶名太長。',
        'weak' => '弱密碼。',
        'wrong_current_password' => '密碼不正確.',
        'wrong_email_confirmation' => '重複新郵箱與新郵箱不一致。',
        'wrong_password_confirmation' => '重複新密碼與新密碼不一致。',
        'too_long' => '超出長度限制——最多為 :limit 個字符。',

        'attributes' => [
            'username' => '使用者名稱',
            'user_email' => '電子郵件地址',
            'password' => '密碼',
        ],

        'change_username' => [
            'restricted' => '帳戶處於限制模式時無法更變使用者名稱。',
            'supporter_required' => [
                '_' => '你必須 :link 才能更改用戶名！',
                'link_text' => '支持 osu!',
            ],
            'username_is_same' => '這就是你的用戶名，Baka！',
        ],
    ],

    'user_report' => [
        'reason_not_valid' => ':reason 不符合此報告類型。',
        'self' => "您不能檢舉你自己！",
    ],

    'store' => [
        'order_item' => [
            'attributes' => [
                'quantity' => '數量',
                'cost' => '成本',
            ],
        ],
    ],
];
