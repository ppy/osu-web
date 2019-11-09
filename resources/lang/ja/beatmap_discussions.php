<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
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
        'title' => 'ビートマップディスカッション',

        'form' => [
            '_' => '検索',
            'deleted' => '削除されたディスカッションを含める',
            'only_unresolved' => '',
            'types' => 'メッセージの種類',
            'username' => 'ユーザー名',

            'beatmapset_status' => [
                '_' => '',
                'all' => '',
                'disqualified' => '',
                'never_qualified' => '',
                'qualified' => '',
                'ranked' => '',
            ],

            'user' => [
                'label' => 'ユーザー',
                'overview' => 'アクティビティ',
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

    'user_filter' => [
        'everyone' => '全てのユーザー',
        'label' => 'ユーザーで絞り込む',
    ],
];
