<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

return [
    'edit' => [
        'title_compact' => '設定',
        'username' => 'ユーザー名',

        'avatar' => [
            'title' => 'プロフィール画像',
            'reset' => 'リセット',
            'rules' => 'あなたのプロフィール画像が公序良俗に反したもので無いか確認してください。 :link.<br/>易しく言えば<strong>全ての年齢に適した</strong>、つまりヌードや冒涜的な表現などを想起させるものを含んでいない事を確認してください。',
            'rules_link' => 'コミュニティールール',
        ],

        'email' => [
            'new' => '新しいメールアドレス',
            'new_confirmation' => '新しいメールアドレス（再入力）',
            'title' => 'メールアドレス',
            'locked' => [
                '_' => 'メールアドレスの更新が必要な場合は、 :accounts までご連絡ください。',
                'accounts' => 'アカウントサポートチーム',
            ],
        ],

        'legacy_api' => [
            'api' => 'api',
            'irc' => 'irc',
            'title' => 'レガシーAPI',
        ],

        'password' => [
            'current' => '現在のパスワード',
            'new' => '新しいパスワード',
            'new_confirmation' => '新しいパスワード（再入力）',
            'title' => 'パスワード',
        ],

        'profile' => [
            'country' => '国',
            'title' => 'プロフィール',

            'country_change' => [
                '_' => "アカウントの国が居住国と一致しません。 :update_link.",
                'update_link' => ':country に更新',
            ],

            'user' => [
                'user_discord' => '',
                'user_from' => '現在地',
                'user_interests' => '趣味',
                'user_occ' => '職業',
                'user_twitter' => '',
                'user_website' => 'ウェブサイト',
            ],
        ],

        'signature' => [
            'title' => '署名',
            'update' => '更新',
        ],
    ],

    'github_user' => [
        'info' => "osu! のオープンソースリポジトリへのコントリビューターであれば、ここでGitHubアカウントをリンクすると、更新ログエントリがosu! プロフィールに関連付けられます。 osu! への貢献履歴がないGitHubアカウントはリンクできません。",
        'link' => 'GitHubアカウントをリンク',
        'title' => 'GitHub',
        'unlink' => 'GitHubアカウントのリンクを解除',

        'error' => [
            'already_linked' => 'この GitHub アカウントはすでに別のユーザにリンクされています。',
            'no_contribution' => 'osu!リポジトリにコントリビューション履歴がなければGitHubアカウントをリンクできません。',
            'unverified_email' => 'GitHubでEメールを確認してから、もう一度アカウントをリンクしてみてください。',
        ],
    ],

    'notifications' => [
        'beatmapset_discussion_qualified_problem' => '次のモードのQualifiedビートマップで新しい問題の通知を受け取る',
        'beatmapset_disqualify' => '次のモードのビートマップがDisqualifiedになった場合に通知を受け取る',
        'comment_reply' => 'コメントへの返信の通知を受け取る',
        'title' => '通知',
        'topic_auto_subscribe' => '作成した新しいフォーラムトピックに関する通知を自動的に有効にします',

        'options' => [
            '_' => '配送設定',
            'beatmap_owner_change' => 'ゲスト難易度',
            'beatmapset:modding' => 'ビートマップmodding',
            'channel_message' => 'プライベートチャットメッセージ',
            'channel_team' => 'チームチャットメッセージ',
            'comment_new' => '新しいコメント',
            'forum_topic_reply' => 'トピックへの返信',
            'mail' => 'メール',
            'mapping' => 'ビートマップマッパー',
            'push' => 'プッシュ通知',
        ],
    ],

    'oauth' => [
        'authorized_clients' => '認証済みのクライアント',
        'own_clients' => '自分のクライアント',
        'title' => 'OAuth',
    ],

    'options' => [
        'beatmapset_show_nsfw' => 'ビートマップ内の不適切なコンテンツの警告を非表示にする',
        'beatmapset_title_show_original' => 'ビートマップのメタデータを元の言語で表示',
        'title' => 'オプション',

        'beatmapset_download' => [
            '_' => 'デフォルトのビートマップダウンロードタイプ',
            'all' => '可能であれば動画付き',
            'direct' => 'osu!directで開く',
            'no_video' => '動画なし',
        ],
    ],

    'playstyles' => [
        'keyboard' => 'キーボード',
        'mouse' => 'マウス',
        'tablet' => 'ペンタブ',
        'title' => 'プレイスタイル',
        'touch' => 'タッチスクリーン',
    ],

    'privacy' => [
        'friends_only' => 'フレンドリストにいない人からのプライベートメッセージをブロックする',
        'hide_online' => 'オンライン状態を隠す',
        'hide_online_info' => '',
        'title' => 'プライバシー',
    ],

    'security' => [
        'current_session' => '現在',
        'end_session' => 'セッション終了',
        'end_session_confirmation' => 'このデバイスでのセッションが終了します。本当によろしいですか？',
        'last_active' => '最終ログイン：',
        'title' => 'セキュリティ',
        'web_sessions' => 'webセッション',
    ],

    'update_email' => [
        'update' => '更新',
    ],

    'update_password' => [
        'update' => '更新',
    ],

    'user_totp' => [
        'title' => '',
        'usage_note' => '',

        'button' => [
            'remove' => '',
            'setup' => '',
        ],
        'status' => [
            'label' => '',
            'not_set' => '',
            'set' => '',
        ],
    ],

    'verification_completed' => [
        'text' => '今すぐにこのウィンドウを閉じる事が出来ます。',
        'title' => '認証が完了しました。',
    ],

    'verification_invalid' => [
        'title' => '無効もしくは期限切れの認証リンク',
    ],
];
