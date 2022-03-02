<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => '設定',
        'username' => '使用者名稱',

        'avatar' => [
            'title' => '編輯頭像',
            'rules' => '請確保您的頭像符合 :link.<br/>這意味著必須 <strong>適合所有年齡</strong>. i.e. 沒有裸露，褻瀆或暗示性的內容。',
            'rules_link' => '社群規則',
        ],

        'email' => [
            'current' => '目前電子郵件地址',
            'new' => '新電子郵件地址',
            'new_confirmation' => '再次輸入電子郵件地址',
            'title' => '電子郵件',
        ],

        'password' => [
            'current' => '目前密碼',
            'new' => '新密碼',
            'new_confirmation' => '再次輸入新密碼',
            'title' => '密碼',
        ],

        'profile' => [
            'title' => '個人資料',

            'user' => [
                'user_discord' => '',
                'user_from' => '目前所在地',
                'user_interests' => '喜好',
                'user_occ' => '職業',
                'user_twitter' => '',
                'user_website' => '個人網站',
            ],
        ],

        'signature' => [
            'title' => '簽名',
            'update' => '更新',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => '在以下模式的 qualified 圖譜上接收新問題通知',
        'beatmapset_disqualify' => '在以下模式的圖譜被標記為取消提名時收到通知',
        'comment_reply' => '在您的留言被回覆時收到通知',
        'title' => '通知',
        'topic_auto_subscribe' => '自動啟用自己創建的主題的通知',

        'options' => [
            '_' => '傳送選項',
            'beatmap_owner_change' => '客串難度',
            'beatmapset:modding' => '圖譜製作',
            'channel_message' => '私人訊息',
            'comment_new' => '新評論',
            'forum_topic_reply' => '主題回覆',
            'mail' => '郵箱',
            'mapping' => '圖譜製作者',
            'push' => '推送',
            'user_achievement_unlock' => '成就解鎖',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '已授權客戶端',
        'own_clients' => '擁有的客戶端',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => '隱藏兒童不宜圖譜的警告',
        'beatmapset_title_show_original' => '以原語言顯示圖譜資料',
        'title' => '選項',

        'beatmapset_download' => [
            '_' => '預設圖譜下載類型',
            'all' => '包含影片',
            'direct' => '在osu!direct中查看',
            'no_video' => '不包含影片',
        ],
    ],

    'playstyles' => [
        'keyboard' => '鍵盤',
        'mouse' => '滑鼠',
        'tablet' => '繪圖板',
        'title' => '遊戲方式',
        'touch' => '觸控螢幕',
    ],

    'privacy' => [
        'friends_only' => '過濾來自好友以外的訊息',
        'hide_online' => '隱藏在線狀態',
        'title' => '隱私政策',
    ],

    'security' => [
        'current_session' => '目前',
        'end_session' => '終止會話',
        'end_session_confirmation' => '你確定要立刻結束該設備上的會話嗎？',
        'last_active' => '上次使用：',
        'title' => '安全',
        'web_sessions' => '瀏覽器會話',
    ],

    'update_email' => [
        'update' => '更新',
    ],

    'update_password' => [
        'update' => '更新',
    ],

    'verification_completed' => [
        'text' => '您可以關閉此選項/視窗',
        'title' => '驗證已經完成',
    ],

    'verification_invalid' => [
        'title' => '無效或過期的驗證連結',
    ],
];
