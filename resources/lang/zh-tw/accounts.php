<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>.
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
    'edit' => [
        'title_compact' => '設定',
        'username' => '使用者名稱',

        'avatar' => [
            'title' => '編輯頭像',
            'rules' => '請確保您的頭像堅持 :link.<br/>這意味著必須 <strong>適合所有年齡</strong>. i.e. 沒有裸露，褻瀆或暗示性的內容。',
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
            'title' => '編輯個人簡介',

            'user' => [
                'user_discord' => 'Discord',
                'user_from' => '目前所在地',
                'user_interests' => '喜好',
                'user_msnm' => 'skype',
                'user_occ' => '職業',
                'user_twitter' => 'twitter',
                'user_website' => '個人網站',
            ],
        ],

        'signature' => [
            'title' => '簽名',
            'update' => '更新',
        ],
    ],

    'notifications' => [
        'title' => '通知',
        'topic_auto_subscribe' => '自動啟用自己創建的主題的通知',
        'beatmapset_discussion_qualified_problem' => '在以下模式的 qualified 圖譜上接收新問題通知',

        'mail' => [
            '_' => '接收以下有關的電子郵件通知',
            'beatmapset:modding' => '圖譜製作',
            'forum_topic_reply' => '主題回復',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '已授權客戶端',
        'own_clients' => '擁有的客戶端',
        'title' => 'OAuth',
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
