<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'missing_route' => '',
    'no_restricted_access' => 'アカウントが制限されている状態では実行できません。',
    'supporter_only' => 'osu!サポーター限定の機能です。',
    'unknown' => '不明のエラーが発生しました。',

    'codes' => [
        'http-401' => '続行するにはログインが必要です。',
        'http-403' => 'アクセスが拒否されました。',
        'http-404' => '見つかりませんでした。',
        'http-429' => '試行回数が上限に達しました。しばらく時間をおいて再度お試しください。',
    ],
    'account' => [
        'profile-order' => [
            'generic' => 'エラーが発生しました。ページの更新をすると直る可能性があります。',
        ],
    ],
    'beatmaps' => [
        'invalid_mode' => '無効なモードが選択されました。',
        'standard_converts_only' => 'このビートマップの難易度には要求されたモードのスコアはありません。',
    ],
    'checkout' => [
        'generic' => '支払い準備中にエラーが発生しました。',
    ],
    'search' => [
        'default' => '結果の取得に失敗しました。もう一度お試しください。',
        'operation_timeout_exception' => '検索機能が平時より混み合っています。もう一度お試しください。',
    ],
];
