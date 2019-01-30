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
        'title' => '<strong>帳號</strong>設定',
        'title_compact' => '設定',
        'username' => '使用者名稱',

        'avatar' => [
            'title' => '編輯頭像',
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
                'user_from' => '目前所在地',
                'user_interests' => '喜好',
                'user_msnm' => 'skype',
                'user_occ' => '職業',
                'user_twitter' => 'twitter',
                'user_website' => '個人網站',
                'user_discord' => 'Discord',
            ],
        ],

        'signature' => [
            'title' => '簽名',
            'update' => '更新',
        ],
    ],

    'update_email' => [
        'email_subject' => 'osu! 帳號電子郵件變更',
        'update' => '更新',
    ],

    'update_password' => [
        'email_subject' => 'osu! 帳號密碼變更',
        'update' => '更新',
    ],

    'playstyles' => [
        'title' => '遊戲方式',
        'mouse' => '滑鼠',
        'keyboard' => '鍵盤',
        'tablet' => '繪圖板',
        'touch' => '觸控螢幕',
    ],

    'privacy' => [
        'title' => '隱私政策',
        'friends_only' => '過濾來自好友以外的訊息',
        'hide_online' => '隱藏在線狀態',
    ],

    'security' => [
        'current_session' => '目前',
        'end_session' => '終止會話',
        'end_session_confirmation' => '你確定要立刻結束該設備上的會話嗎？',
        'last_active' => '上次使用：',
        'title' => '安全',
        'web_sessions' => '瀏覽器會話',
    ],
];
