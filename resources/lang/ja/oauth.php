<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'cancel' => 'キャンセル',

    'authorise' => [
        'request' => 'アカウントへのアクセス許可を要求しています。',
        'scopes_title' => 'このアプリケーションは次のことができます：',
        'title' => '認証をリクエスト',
    ],

    'authorized_clients' => [
        'confirm_revoke' => 'このクライアントの認証を無効化しますか？',
        'scopes_title' => 'このアプリケーションでできること:',
        'owned_by' => '所有者 :user',
        'none' => 'クライアントがありません',

        'revoked' => [
            'false' => 'アクセスを無効化',
            'true' => 'アクセスが無効化されました',
        ],
    ],

    'client' => [
        'id' => 'クライアントID',
        'name' => 'アプリケーション名',
        'redirect' => 'アプリケーションコールバックURL',
        'reset' => 'クライアントシークレットをリセット',
        'reset_failed' => 'クライアントシークレットのリセットに失敗',
        'secret' => 'クライアントシークレット',

        'secret_visible' => [
            'false' => 'クライアントシークレットを表示',
            'true' => 'クライアントシークレットを非表示',
        ],
    ],

    'new_client' => [
        'header' => '新しいOAuthアプリケーションを登録する',
        'register' => 'アプリケーションを登録',
        'terms_of_use' => [
            '_' => 'APIを使用すると、:linkに同意したことになります。',
            'link' => '利用規約',
        ],
    ],

    'own_clients' => [
        'confirm_delete' => '本当にこのクライアントを削除しますか？',
        'confirm_reset' => '本当にクライアントシークレットをリセットしてもいいですか？これにより全てのトークンが取り消されます。',
        'new' => '新しいOAuthアプリケーション',
        'none' => 'クライアントがありません',

        'revoked' => [
            'false' => '削除',
            'true' => '削除しました',
        ],
    ],
];
