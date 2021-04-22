<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'authorizations' => [
        'update' => [
            'null_user' => '編集するにはログインが必要です。',
            'system_generated' => '自動生成された投稿は編集できません。',
            'wrong_user' => '投稿者以外は編集できません。',
        ],
    ],

    'events' => [
        'empty' => 'まだ何もありません。',
    ],

    'index' => [
        'deleted_beatmap' => '削除済み',
        'none_found' => '検索条件に一致するディスカッションは見つかりませんでした。',
        'title' => 'ビートマップディスカッション',

        'form' => [
            '_' => '検索',
            'deleted' => '削除されたディスカッションを含める',
            'mode' => '',
            'only_unresolved' => '未解決のディスカッションのみ表示',
            'types' => 'メッセージの種類',
            'username' => 'ユーザー名',

            'beatmapset_status' => [
                '_' => 'ビートマップ ステータス',
                'all' => '全て',
                'disqualified' => 'Disqualified',
                'never_qualified' => 'Never Qualified',
                'qualified' => 'Qualified',
                'ranked' => 'Ranked',
            ],

            'user' => [
                'label' => 'ユーザー',
                'overview' => 'アクティビティ概要',
            ],
        ],
    ],

    'item' => [
        'created_at' => '投稿日',
        'deleted_at' => '削除日',
        'message_type' => 'メッセージの種類',
        'permalink' => 'パーマリンク',
    ],

    'nearby_posts' => [
        'confirm' => '私が知りたいことに関する投稿はまだありません',
        'notice' => ':timestamp付近に他の投稿(:existing_timestamps)があります。投稿する前に確認してください。',
        'unsaved' => ':count 個がこのレビューにあります',
    ],

    'reply' => [
        'open' => [
            'guest' => 'ログインして返信する',
            'user' => '返信する',
        ],
    ],

    'review' => [
        'block_count' => ':used / :max ブロックを使用',
        'go_to_parent' => 'レビュー投稿を表示',
        'go_to_child' => 'ディスカッションを表示',
        'validation' => [
            'block_too_large' => '各ブロックは :limit 文字までしか含めることができません',
            'external_references' => 'レビューには、このレビューに属していない問題への参照が含まれています',
            'invalid_block_type' => '無効なブロックタイプ',
            'invalid_document' => '無効なレビュー',
            'minimum_issues' => 'レビューには最低:count件の問題が含まれている必要があります',
            'missing_text' => 'ブロックにテキストがありません',
            'too_many_blocks' => 'レビューには:count件の段落/問題のみが含まれている場合があります',
        ],
    ],

    'system' => [
        'resolved' => [
            'true' => ':userに解決済とマークされました',
            'false' => ':userによって再開されました。',
        ],
    ],

    'timestamp_display' => [
        'general' => '全般',
        'general_all' => '全般（全て）',
    ],

    'user_filter' => [
        'everyone' => '全てのユーザー',
        'label' => 'ユーザーで絞り込む',
    ],
];
