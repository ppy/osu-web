<?php

/**
 *    Copyright 2015-2018 ppy Pty. Ltd.
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
        'invalid_mode' => '指定のモードは無効です。',
        'standard_converts_only' => 'この難易度の指定のモードのスコアは見つかりませんでした。',
    ],
    'beatmapsets' => [
        'too-many-favourites' => 'お気に入りの数の上限に達しています。お気に入り譜面の数を減らしましょう。',
    ],
    'logged_out' => 'ログアウトされています。ログインしてから再度お試しください。',
    'supporter_only' => 'サポーター限定の機能です。',
    'no_restricted_access' => 'アカウントが制限中は無効です。',
    'unknown' => '不明のエラーが発生しました。',
];
