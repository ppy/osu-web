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

    'logged_out' => 'ログアウトされています。ログインしてから再度お試しください。',
    'supporter_only' => 'osu!サポーター限定の機能です。',
    'no_restricted_access' => 'アカウントが制限中は無効です。',
    'unknown' => '不明のエラーが発生しました。',
];
