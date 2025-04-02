<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'applications' => [
        'accept' => [
            'ok' => 'ユーザーをチームに追加しました。',
        ],
        'destroy' => [
            'ok' => '参加申請をキャンセルしました。',
        ],
        'reject' => [
            'ok' => '参加申請が拒否されました。',
        ],
        'store' => [
            'ok' => 'チームへの参加をリクエストしました。',
        ],
    ],

    'create' => [
        'submit' => 'チームを作成',

        'form' => [
            'name_help' => 'チーム名。現在一度決めたチーム名は変更できません。',
            'short_name_help' => '最大 4 文字。',
            'title' => "新しいチームを作成しましょう",
        ],

        'intro' => [
            'description' => "既存のフレンドや新しいフレンドと一緒にプレイします。現在、あなたはチームに所属していません。チームページにアクセスして既存のチームに所属するか、このページからチームを作成してください。",
            'title' => 'チーム！',
        ],
    ],

    'destroy' => [
        'ok' => 'チームを削除しました',
    ],

    'edit' => [
        'ok' => '設定が正常に保存されました。',
        'title' => 'チームの設定',

        'description' => [
            'label' => '説明',
            'title' => 'チームの説明',
        ],

        'flag' => [
            'label' => 'チームフラグ',
            'title' => 'チームフラグを設定',
        ],

        'header' => [
            'label' => 'ヘッダー画像',
            'title' => 'ヘッダー画像を設定',
        ],

        'settings' => [
            'application_help' => 'チームへの参加申請を許可するかどうか',
            'default_ruleset_help' => 'チームのページにアクセスしたときにデフォルトで表示されるルールセット',
            'flag_help' => '最大サイズ :width×:height',
            'header_help' => '最大サイズ :width×:height',
            'title' => 'チームの設定',

            'application_state' => [
                'state_0' => '申請不可',
                'state_1' => '申請可能',
            ],
        ],
    ],

    'header_links' => [
        'edit' => '設定',
        'leaderboard' => 'リーダーボード',
        'show' => '情報',

        'members' => [
            'index' => 'メンバーの管理',
        ],
    ],

    'leaderboard' => [
        'global_rank' => '世界ランキング',
    ],

    'members' => [
        'destroy' => [
            'success' => 'チームメンバーを削除しました',
        ],

        'index' => [
            'title' => 'メンバーの管理',

            'applications' => [
                'empty' => '現在参加申請はありません。',
                'empty_slots' => '空きスロット',
                'title' => '参加リクエスト',
                'created_at' => '申請日',
            ],

            'table' => [
                'status' => 'ステータス',
                'joined_at' => '参加日',
                'remove' => '削除',
                'title' => '現在参加しているメンバー',
            ],

            'status' => [
                'status_0' => '非アクティブ',
                'status_1' => 'アクティブ',
            ],
        ],
    ],

    'part' => [
        'ok' => 'チームから退出しました ;_;',
    ],

    'show' => [
        'bar' => [
            'chat' => 'チームチャット',
            'destroy' => 'チームを解散',
            'join' => '参加をリクエスト',
            'join_cancel' => 'リクエストを取り消し',
            'part' => 'チームから抜ける',
        ],

        'info' => [
            'created' => '結成日',
        ],

        'members' => [
            'members' => 'チームメンバー',
            'owner' => 'チームリーダー',
        ],

        'sections' => [
            'about' => '',
            'info' => '情報',
            'members' => 'メンバー',
        ],

        'statistics' => [
            'rank' => '',
            'leader' => '',
        ],
    ],

    'store' => [
        'ok' => 'チームを作成しました。',
    ],
];
