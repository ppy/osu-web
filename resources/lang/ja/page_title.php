<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'admin' => [
        '_' => '管理者',
    ],
    'error' => [
        'error' => [
            '400' => '無効なリクエスト',
            '404' => '見つかりません',
            '403' => 'アクセス禁止',
            '401' => '未認証',
            '401-verification' => 'アカウント認証',
            '405' => '見つかりません',
            '422' => '無効なリクエスト',
            '429' => 'リクエストが多すぎます',
            '500' => '予期せぬエラー',
            '503' => 'メンテナンス',
        ],
    ],
    'forum' => [
        '_' => 'フォーラム',
        'topic_logs_controller' => [
            'index' => 'トピックログ',
        ],
    ],
    'main' => [
        'account_controller' => [
            'verify_link' => 'アカウント認証',
        ],
        'artists_controller' => [
            '_' => '注目アーティスト',
        ],
        'beatmap_discussion_posts_controller' => [
            '_' => 'ビートマップディスカッションの投稿',
        ],
        'beatmap_discussions_controller' => [
            '_' => 'ビートマップディスカッション',
        ],
        'beatmap_packs_controller' => [
            '_' => 'ビートマップパック',
        ],
        'beatmapset_discussion_votes_controller' => [
            '_' => 'ビートマップディスカッションの投票',
        ],
        'beatmapset_events_controller' => [
            '_' => 'ビートマップ履歴',
        ],
        'beatmapsets_controller' => [
            'discussion' => 'ビートマップディスカッション',
            'index' => 'ビートマップリスト',
            'show' => 'ビートマップ情報',
        ],
        'changelog_controller' => [
            '_' => '更新履歴',
        ],
        'chat_controller' => [
            '_' => 'チャット',
        ],
        'comments_controller' => [
            '_' => 'コメント',
        ],
        'contest_entries_controller' => [
            'judge_results' => 'コンテストの審査結果',
        ],
        'contests_controller' => [
            '_' => 'コンテスト',
            'judge' => 'コンテストの審査',
        ],
        'groups_controller' => [
            'show' => 'グループ',
        ],
        'home_controller' => [
            'get_download' => 'ダウンロード',
            'index' => 'ダッシュボード',
            'search' => '検索',
            'support_the_game' => 'ゲームを支援',
            'testflight' => 'testflight',
        ],
        'legacy_matches_controller' => [
            '_' => '',
        ],
        'legal_controller' => [
            '_' => '情報',
        ],
        'livestreams_controller' => [
            '_' => 'ライブストリーム',
        ],
        'news_controller' => [
            '_' => 'ニュース',
        ],
        'notifications_controller' => [
            '_' => '通知履歴',
        ],
        'password_reset_controller' => [
            '_' => 'パスワードリセット',
        ],
        'ranking_controller' => [
            '_' => 'ランキング',
        ],
        'scores_controller' => [
            '_' => 'パフォーマンス',
        ],
        'seasons_controller' => [
            '_' => 'ランキング',
        ],
        'teams_controller' => [
            '_' => 'チーム',
            'create' => 'チームの作成',
            'edit' => 'チームの設定',
            'leaderboard' => 'チームリーダーボード',
            'show' => 'チーム情報',
        ],
        'tournaments_controller' => [
            '_' => 'トーナメント',
        ],
        'user_cover_presets_controller' => [
            '_' => 'ユーザーカバープリセット',
        ],
        'users_controller' => [
            '_' => 'プレイヤー情報',
            'create' => 'アカウント作成',
            'disabled' => '通知',
        ],
        'wiki_controller' => [
            '_' => 'wiki',
        ],
    ],
    'multiplayer' => [
        'rooms_controller' => [
            'events' => '',
        ],
    ],
    'passport' => [
        'authorization_controller' => [
            '_' => 'アプリを認証',
        ],
    ],
    'store' => [
        '_' => 'ストア',
    ],
    'teams' => [
        'members_controller' => [
            'index' => 'チームメンバー',
        ],
    ],
    'users' => [
        'modding_history_controller' => [
            '_' => 'modder情報',
        ],
        'multiplayer_controller' => [
            '_' => 'マルチプレイヤー履歴',
        ],
    ],
];
