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
    'cancel' => '取消',

    'authorise' => [
        'authorise' => '授權',
        'request' => '正在要求權限以存取你的帳號。',
        'scopes_title' => '此應用程式將可以：',
        'title' => '授權請求',

        'wrong_user' => [
            '_' => '您已以 :user 的身分登入。 :logout_link',
            'logout_link' => '點擊此處以不同帳號登入。',
        ],
    ],

    'authorized_clients' => [
        'confirm_revoke' => '您確定要撤消此客戶端的權限嗎？',
        'scopes_title' => '這個應用程式可以:',
        'owned_by' => '擁有者 :user',
        'none' => '沒有客戶端',

        'revoked' => [
            'false' => '',
            'true' => '',
        ],
    ],

    'client' => [
        'id' => '客戶端 ID',
        'name' => '應用程式名稱',
        'redirect' => '',
        'secret' => '',
    ],

    'login' => [
        'download' => '點擊這裡下載遊戲並創建一個帳戶',
        'label' => '首先，登入您的帳號吧！',
        'title' => '登入',
    ],

    'new_client' => [
        'header' => '',
        'register' => '註冊應用程式',
        'terms_of_use' => [
            '_' => '在使用API之前您必須同意 :link.',
            'link' => '使用條款',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '您確定要刪除此客戶端嗎？',
        'new' => '新增 OAuth 應用程式',
        'none' => '沒有客戶端',

        'revoked' => [
            'false' => '刪除',
            'true' => '已刪除',
        ],
    ],
];
