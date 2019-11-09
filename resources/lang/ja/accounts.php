<?php

/**
 *    Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
 *    See the LICENCE file in the repository root for full licence text.
 */

return [
    'edit' => [
        'title' => '<strong>アカウント</strong>設定',
        'title_compact' => '設定',
        'username' => 'ユーザー名',

        'avatar' => [
            'title' => 'プロフィール画像',
            'rules' => 'あなたのプロフィール画像が公序良俗に反したもので無いか確認してください。 :link.<br/>易しく言えば<strong>全ての年齢に適した</strong>、つまりヌードや冒涜的な表現などを想起させるものを含んでいない事を確認してください。',
            'rules_link' => 'コミュニティールール',
        ],

        'email' => [
            'current' => '現在のメールアドレス',
            'new' => '新しいメールアドレス',
            'new_confirmation' => '新しいメールアドレス（再入力）',
            'title' => 'メールアドレス',
        ],

        'password' => [
            'current' => '現在のパスワード',
            'new' => '新しいパスワード',
            'new_confirmation' => '新しいパスワード（再入力）',
            'title' => 'パスワード',
        ],

        'profile' => [
            'title' => 'プロフィール',

            'user' => [
                'user_discord' => 'discord',
                'user_from' => '現在地',
                'user_interests' => '趣味',
                'user_msnm' => 'skype',
                'user_occ' => '職業',
                'user_twitter' => 'twitter',
                'user_website' => 'ウェブサイト',
            ],
        ],

        'signature' => [
            'title' => '署名',
            'update' => '更新',
        ],
    ],

    'notifications' => [
        'title' => '通知',
        'topic_auto_subscribe' => '作成した新しいフォーラムトピックに関する通知を自動的に有効にします',
        'beatmapset_discussion_qualified_problem' => '',
    ],

    'oauth' => [
        'authorized_clients' => '認証済みのクライアント',
        'own_clients' => '自分のクライアント',
        'title' => 'OAuth',
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
        'email_subject' => 'メールアドレス変更の確認',
        'update' => '更新',
    ],

    'update_password' => [
        'email_subject' => 'パスワード変更の確認',
        'update' => '更新',
    ],

    'verification_completed' => [
        'text' => '今すぐにこのウィンドウを閉じる事が出来ます。',
        'title' => '認証が完了しました。',
    ],

    'verification_invalid' => [
        'title' => '無効もしくは期限切れの認証リンク',
    ],
];
