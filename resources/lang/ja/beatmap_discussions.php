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
        'title' => 'ビートマップディスカッション',

        'form' => [
            '_' => '検索',
            'deleted' => '削除されたディスカッションを含める',
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

    'review' => [
        'go_to_parent' => 'レビュー投稿を表示',
        'go_to_child' => 'ディスカッションを表示',
        'validation' => [
            'invalid_block_type' => '',
            'invalid_document' => '',
            'minimum_issues' => '',
            'missing_text' => '',
            'too_many_blocks' => '',
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
