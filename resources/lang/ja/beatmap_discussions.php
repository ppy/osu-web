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
    'authorizations' => [
        'update' => [
            'null_user' => '編集するにはログインが必要です。',
            'system_generated' => '自動生成された投稿は編集できません。',
            'wrong_user' => '投稿者にのみ編集できます。',
        ],
    ],

    'events' => [
        'empty' => 'まだ何もありません。',
    ],

    'index' => [
        'deleted_beatmap' => '削除済み',
        'title' => 'ディスカッション',

        'form' => [
            '_' => '検索',
            'deleted' => '削除されたディスカッションを含む',
            'types' => 'メッセージの種類',
            'username' => 'ユーザー名',

            'user' => [
                'label' => 'ユーザー',
                'overview' => '活動概要',
            ],
        ],
    ],

    'item' => [
        'created_at' => '投稿日',
        'deleted_at' => '削除日',
        'message_type' => 'タイプ',
        'permalink' => 'パーマリンク',
    ],

    'nearby_posts' => [
        'confirm' => '私が知りたいことに関する投稿はまだありません',
        'notice' => ':timestamp付近に他の投稿(:existing_timestamps)があります。投稿する前に確認してください。',
    ],

    'reply' => [
        'open' => [
            'guest' => 'ログインして返信する',
            'user' => '返信する',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':userに解決済とマークされました',
            'false' => ':userによって再開されました。',
        ],
    ],

    'user' => [
        'admin' => '管理者',
        'bng' => 'ノミネーター',
        'owner' => '譜面作者',
        'qat' => 'qat',
    ],

    'user_filter' => [
        'everyone' => '全てのユーザー',
        'label' => 'ユーザーで絞り込む',
    ],
];
