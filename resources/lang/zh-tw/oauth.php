<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => '取消',

    'authorise' => [
        'request' => '正在要求權限以存取你的帳號。',
        'scopes_title' => '此應用程式將可以：',
        'title' => '授權請求',
    ],

    'authorized_clients' => [
        'confirm_revoke' => '您確定要撤消此客戶端的權限嗎？',
        'scopes_title' => '這個應用程式可以:',
        'owned_by' => '擁有者 :user',
        'none' => '沒有客戶端',

        'revoked' => [
            'false' => '撤回存取權限',
            'true' => '存取遭撤回',
        ],
    ],

    'client' => [
        'id' => '客戶端 ID',
        'name' => '應用程式名稱',
        'redirect' => '應用程式回傳 URL',
        'reset' => '重置客戶端密鑰',
        'reset_failed' => '重置客戶端密鑰失敗',
        'secret' => '用戶端密鑰',

        'secret_visible' => [
            'false' => '顯示客戶端密鑰',
            'true' => '隱藏客戶端密鑰',
        ],
    ],

    'new_client' => [
        'header' => '註冊一個新的 OAuth 應用程式',
        'register' => '註冊應用程式',
        'terms_of_use' => [
            '_' => '在使用API之前您必須同意 :link.',
            'link' => '使用條款',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '您確定要刪除此客戶端嗎？',
        'confirm_reset' => '您確定鑰重置客戶端密鑰嗎? 這將撤銷現有的所有token。',
        'new' => '新增 OAuth 應用程式',
        'none' => '沒有客戶端',

        'revoked' => [
            'false' => '刪除',
            'true' => '已刪除',
        ],
    ],
];
