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
        'secret' => 'Client Secret',
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
        'confirm_delete' => 'あなたは本当にクライアントを削除しますか？',
        'new' => '新しいOAuthアプリケーション',
        'none' => 'クライアントがありません',

        'revoked' => [
            'false' => '削除',
            'true' => '削除しました',
        ],
    ],
];
